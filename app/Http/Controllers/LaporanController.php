<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = auth()->user()->laporans()->latest()->paginate(10);

        return view('siswa.laporan.index', compact('laporans'));
    }

    public function create()
    {
        return view('siswa.laporan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'    => 'required|string|max:150',
            'kategori' => 'required|in:fasilitas,kekerasan,guru,kebersihan,lainnya',
            'isi'      => 'required|string|min:20',
            'lampiran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('lampiran', 'public');
        }

        $data['user_id'] = auth()->id();
        $data['kode']    = 'LP-' . strtoupper(Str::random(8));

        Laporan::create($data);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil dikirim. Tunggu diproses admin ya.');
    }

    public function show(Laporan $laporan)
    {
        // siswa cuma boleh lihat laporan miliknya sendiri
        abort_if($laporan->user_id !== auth()->id(), 403);

        return view('siswa.laporan.show', compact('laporan'));
    }
}