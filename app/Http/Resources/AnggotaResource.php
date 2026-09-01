<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnggotaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'no_hp' => $this->no_hp,
            'alamat' => $this->maskAddress($this->alamat),
            'tanggal_daftar' => $this->tanggal_daftar,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    protected function maskAddress(?string $address): ?string
    {
        if (! $address) {
            return null;
        }

        $length = mb_strlen($address);

        if ($length <= 6) {
            return str_repeat('*', $length);
        }

        return mb_substr($address, 0, 3)
            . str_repeat('*', $length - 6)
            . mb_substr($address, -3);
    }
}
