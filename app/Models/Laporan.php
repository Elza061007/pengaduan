<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'kode', 'judul', 'kategori', 'isi',
        'lampiran', 'status', 'tanggapan', 'diproses_at',
    ];

    protected $casts = [
        'diproses_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function badgeClass(): string
    {
        return match ($this->status) {
            'menunggu' => 'bg-gray-100 text-gray-700',
            'diproses' => 'bg-yellow-100 text-yellow-800',
            'selesai'  => 'bg-green-100 text-green-800',
            'ditolak'  => 'bg-red-100 text-red-800',
        };
    }
}