<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;
use App\Http\Resources\PeminjamanResource;
use App\Services\PeminjamanService;
use App\Traits\ApiResponse;

class PeminjamanController extends Controller
{
    use ApiResponse;

    public function __construct(protected PeminjamanService $peminjamanService) {}

    public function index()
    {
        return $this->success(PeminjamanResource::collection($this->peminjamanService->index()));
    }

    public function show(string $id)
    {
        return $this->success(new PeminjamanResource($this->peminjamanService->show($id)));
    }

    public function store(StorePeminjamanRequest $request)
    {
        $peminjaman = $this->peminjamanService->pinjam($request->validated());

        return $this->success(new PeminjamanResource($peminjaman), 'Peminjaman berhasil dibuat', 201);
    }

    public function update(UpdatePeminjamanRequest $request, string $id)
    {
        $peminjaman = $this->peminjamanService->update($id, $request->validated());

        return $this->success(new PeminjamanResource($peminjaman), 'Peminjaman berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $this->peminjamanService->destroy($id);

        return $this->success(null, 'Peminjaman berhasil dihapus');
    }

    public function kembali(string $id)
    {
        $peminjaman = $this->peminjamanService->kembali($id);

        return $this->success(new PeminjamanResource($peminjaman), 'Komik berhasil dikembalikan');
    }
}