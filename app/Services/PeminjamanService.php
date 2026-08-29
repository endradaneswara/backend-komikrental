<?php

namespace App\Services;

use App\Models\Komik;
use App\Models\Peminjaman;
use Exception;
use Illuminate\Database\Eloquent\Collection;

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
            throw new Exception('Stok komik habis, tidak bisa dipinjam');
        }

        $peminjaman = Peminjaman::create([
            'anggota_id' => $data['anggota_id'],
            'komik_id' => $data['komik_id'],
            'tanggal_pinjam' => $data['tanggal_pinjam'] ?? now()->toDateString(),
            'tanggal_kembali' => $data['tanggal_kembali'] ?? null,
            'status' => $data['status'] ?? 'dipinjam',
        ]);

        $komik->decrement('stok');

        return $peminjaman->load(['anggota', 'komik']);
    }

    public function update(string|int $id, array $data): Peminjaman
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $statusSebelum = $peminjaman->status;

        $peminjaman->update($data);

        if (isset($data['status']) && $data['status'] === 'dikembalikan' && $statusSebelum !== 'dikembalikan') {
            $peminjaman->komik()->increment('stok');
        }

        if (isset($data['status']) && $data['status'] !== 'dikembalikan' && $statusSebelum === 'dikembalikan') {
            $peminjaman->komik()->decrement('stok');
        }

        return $peminjaman->fresh()->load(['anggota', 'komik']);
    }

    public function kembali(string|int $id): Peminjaman
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status === 'dikembalikan') {
            throw new Exception('Peminjaman ini sudah dikembalikan');
        }

        $peminjaman->status = 'dikembalikan';
        $peminjaman->tanggal_kembali = $peminjaman->tanggal_kembali ?? now()->toDateString();
        $peminjaman->save();

        $peminjaman->komik()->increment('stok');

        return $peminjaman->fresh()->load(['anggota', 'komik']);
    }

    public function destroy(string|int $id): bool
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status !== 'dikembalikan') {
            $peminjaman->komik()->increment('stok');
        }

        return (bool) $peminjaman->delete();
    }
}