<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKomikRequest;
use App\Http\Requests\UpdateKomikRequest;   
use App\Http\Resources\KomikResource;
use App\Models\Komik;
use App\Services\KomikService;
use App\Traits\ApiResponse;

class KomikController extends Controller 
{ 
    use ApiResponse;

    public function __construct(protected KomikService $komikService) {}

    public function index() 
    { 
        return $this->success (KomikResource::Collection($this->komikService->getAll()));     
    } 
    public function show(string $id) 
    { 
        return $this->success(new KomikResource($this->komikService->getById($id))); 
    } 
    public function store(StoreKomikRequest $request) 
    { 
        $komik = Komik::create($request->validated());
        
        return $this->success(new KomikResource($komik), 'Komik berhasil ditambahkan', 201);
    } 
    public function update(UpdateKomikRequest $request, string $id) 
    { 
        $komik = Komik::findOrFail($id); 
        $komik->update($request->validated()); 
        
        return $this->success(new KomikResource($komik), 'Komik berhasil diupdate');
    } 
    public function destroy(string $id) 
    { 
        Komik::findOrFail($id)->delete(); 
        
        return $this->success(null, 'Komik berhasil dihapus');
    } 
}
