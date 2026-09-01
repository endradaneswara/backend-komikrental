<?php

namespace App\Services;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Collection;

class AnggotaService
{
    public function index(): Collection
    {
        return Anggota::all();
    }

    public function show(string|int $id): Anggota
    {
        return Anggota::findOrFail($id);
    }

    public function store(array $data): Anggota
    {
        return Anggota::create($data);
    }

    public function update(string|int $id, array $data): Anggota
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->update($data);

        return $anggota->fresh();
    }

    public function destroy(string|int $id): void
    {
        Anggota::findOrFail($id)->delete();
    }
}
