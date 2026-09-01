<?php

namespace App\Services;

use App\Models\Komik;
use App\Models\Peminjaman;
use RuntimeException;
use DomainException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PeminjamanService
{
    public function index(): Collection
    {
        return Peminjaman::with(['anggota', 'komik'])->get();
    }

    public function show(string|int $id): Peminjaman
    {
        return Peminjaman::with(['anggota', 'komik'])->findOrFail($id);
    }

    public function pinjam(array $data): Peminjaman
    {
        $komik = Komik::findOrFail($data['komik_id']);

        if ($komik->stok < 1) {
            throw new RuntimeException('Stok komik habis');
        }

        return DB::transaction(function () use ($data, $komik) {
            $peminjaman = Peminjaman::create([
                'anggota_id' => $data['anggota_id'],
                'komik_id' => $data['komik_id'],
                'tanggal_pinjam' => $data['tanggal_pinjam'],
                'status' => 'dipinjam',
            ]);

            $komik->decrement('stok');

        return $peminjaman->fresh(['anggota', 'komik']);
    });
}

    public function update(string|int $id, array $data): Peminjaman
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($data);
        return $peminjaman->fresh(['anggota', 'komik']);
    }

    public function kembali(string|int $id): Peminjaman
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status === 'dikembalikan') {
            throw new DomainException('Peminjaman ini sudah dikembalikan');
        }

        return DB::transaction(function () use ($peminjaman) {
            $peminjaman->update([
                'tanggal_kembali' => now()->toDateString(),
                'status' => 'dikembalikan',
            ]);

            Komik::find($peminjaman->komik_id)->increment('stok');

            return $peminjaman->fresh(['anggota', 'komik']);
        });
    }

    public function destroy(string|int $id): void
    {
        Peminjaman::findOrFail($id)->delete();
    }
}