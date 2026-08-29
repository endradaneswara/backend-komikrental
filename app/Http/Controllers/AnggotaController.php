<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use App\Http\Resources\AnggotaResource;
use App\Services\AnggotaService;
use App\Traits\ApiResponse;

class AnggotaController extends Controller
{
    use ApiResponse;

    public function __construct(protected AnggotaService $anggotaService) {}

    public function index()
    {
        return $this->success(AnggotaResource::collection($this->anggotaService->index()));
    }

    public function show(string $id)
    {
        return $this->success(new AnggotaResource($this->anggotaService->show($id)));
    }

    public function store(StoreAnggotaRequest $request)
    {
        $anggota = $this->anggotaService->store($request->validated());

        return $this->success(new AnggotaResource($anggota), 'Anggota berhasil ditambahkan', 201);
    }

    public function update(UpdateAnggotaRequest $request, string $id)
    {
        $anggota = $this->anggotaService->update($id, $request->validated());

        return $this->success(new AnggotaResource($anggota), 'Anggota berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $this->anggotaService->destroy($id);

        return $this->success(null, 'Anggota berhasil dihapus');
    }
}
