<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeminjamanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'anggota_id' => ['required', 'exists:anggota,id'],
            'komik_id' => ['required', 'exists:komiks,id'],
            'tanggal_pinjam' => ['required', 'date'],
        ];
    }
}
