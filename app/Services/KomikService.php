<?php

namespace App\Services;

use App\Models\Komik;
use Illuminate\Database\Eloquent\Collection;

class KomikService
{
    public function getAll(): Collection
    {
        return Komik::with('kategori')->get();
    }

    public function getById(string|int $id): Komik
    {
        return Komik::with('kategori')->findOrFail($id);
    }

    public function store(array $data): Komik
    {
        return Komik::create($data);
    }

    public function update(string|int $id, array $data): Komik
    {
        $komik = Komik::findOrFail($id);
        $komik->update($data);

        return $komik->fresh();
    }

    public function destroy(string|int $id): bool
    {
        $komik = Komik::findOrFail($id);

        return (bool) $komik->delete();
    }
}