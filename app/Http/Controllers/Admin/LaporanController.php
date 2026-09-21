<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $laporans = Laporan::with('user')
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->when($request->q, fn ($q, $k) => $q->where('judul', 'like', "%{$k}%"))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $statistik = [
            'total'    => Laporan::count(),
            'menunggu' => Laporan::where('status', 'menunggu')->count(),
            'diproses' => Laporan::where('status', 'diproses')->count(),
            'selesai'  => Laporan::where('status', 'selesai')->count(),
        ];

        return view('admin.laporan.index', compact('laporans', 'statistik'));
    }

    public function show(Laporan $laporan)
    {
        return view('admin.laporan.show', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $data = $request->validate([
            'status'    => 'required|in:menunggu,diproses,selesai,ditolak',
            'tanggapan' => 'nullable|string|max:2000',
        ]);

        if ($data['status'] !== 'menunggu' && ! $laporan->diproses_at) {
            $data['diproses_at'] = now();
        }

        $laporan->update($data);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        if ($laporan->lampiran) {
            Storage::disk('public')->delete($laporan->lampiran);
        }

        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan dihapus.');
    }
}