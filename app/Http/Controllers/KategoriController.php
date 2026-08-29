<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Http\Resources\KategoriResource;
use App\Services\KategoriService;
use App\Traits\ApiResponse;

class KategoriController extends Controller
{
    use ApiResponse;

    public function __construct(protected KategoriService $kategoriService) {}

    public function index()
    {
        return $this->success(KategoriResource::collection($this->kategoriService->index()));
    }

    public function show(string $id)
    {
        return $this->success(new KategoriResource($this->kategoriService->show($id)));
    }

    public function store(StoreKategoriRequest $request)
    {
        $kategori = $this->kategoriService->store($request->validated());

        return $this->success(new KategoriResource($kategori), 'Kategori berhasil ditambahkan', 201);
    }

    public function update(UpdateKategoriRequest $request, string $id)
    {
        $kategori = $this->kategoriService->update($id, $request->validated());

        return $this->success(new KategoriResource($kategori), 'Kategori berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $this->kategoriService->destroy($id);

        return $this->success(null, 'Kategori berhasil dihapus');
    }
}