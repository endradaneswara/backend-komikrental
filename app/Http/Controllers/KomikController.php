<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKomikRequest;
use App\Http\Requests\UpdateKomikRequest;
use App\Http\Resources\KomikResource;
use App\Services\KomikService;
use App\Traits\ApiResponse;

class KomikController extends Controller
{
    use ApiResponse;

    public function __construct(protected KomikService $komikService) {}

    public function index()
    {
        return $this->success(KomikResource::collection($this->komikService->getAll()));
    }

    public function show(string $id)
    {
        return $this->success(new KomikResource($this->komikService->getById($id)));
    }

    public function store(StoreKomikRequest $request)
    {
        $komik = $this->komikService->store($request->validated());

        return $this->success(new KomikResource($komik), 'Komik berhasil ditambahkan', 201);
    }

    public function update(UpdateKomikRequest $request, string $id)
    {
        $komik = $this->komikService->update($id, $request->validated());

        return $this->success(new KomikResource($komik), 'Komik berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $this->komikService->destroy($id);

        return $this->success(null, 'Komik berhasil dihapus');
    }
}
