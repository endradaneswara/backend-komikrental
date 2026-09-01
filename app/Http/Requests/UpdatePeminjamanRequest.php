<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePeminjamanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'anggota_id' => ['sometimes', 'required', 'exists:anggota,id'],
            'komik_id' => ['sometimes', 'required', 'exists:komiks,id'],
            'tanggal_pinjam' => ['sometimes', 'date'],
            'tanggal_kembali' => ['sometimes', 'nullable', 'date'],
            'status' => ['sometimes', 'in:dipinjam,dikembalikan,telat'],
        ];
    }
}
