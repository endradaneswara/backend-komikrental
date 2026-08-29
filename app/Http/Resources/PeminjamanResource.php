<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeminjamanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'anggota_id' => $this->anggota_id,
            'anggota' => $this->whenLoaded('anggota', fn () => [
                'id' => $this->anggota?->id,
                'nama' => $this->anggota?->nama,
            ]),
            'komik_id' => $this->komik_id,
            'komik' => $this->whenLoaded('komik', fn () => [
                'id' => $this->komik?->id,
                'judul' => $this->komik?->judul,
            ]),
            'tanggal_pinjam' => $this->tanggal_pinjam,
            'tanggal_kembali' => $this->tanggal_kembali,
            'status' => $this->status,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
