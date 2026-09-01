<?php

namespace App\Services;

use App\Models\Komik;
use Illuminate\Database\Eloquent\Collection;

class KomikService
{
    public function index(): Collection
    {
        return Komik::with('kategori')->get();
    }

    public function show(string|int $id): Komik
    {
        return Komik::with('kategori')->findOrFail($id);
    }

    public function store(array $data): Komik
    {
        return Komik::create($data)->refresh()->load('kategori');
    }

    public function update(string|int $id, array $data): Komik
    {
        $komik = Komik::findOrFail($id);
        $komik->update($data);

        return $komik->fresh('kategori');
    }

    public function destroy(string|int $id): void
    {
        Komik::findOrFail($id)->delete();
    }
}