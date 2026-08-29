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
            'tanggal_pinjam' => ['sometimes', 'required', 'date'],
            'tanggal_kembali' => [
                'sometimes',
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if ($this->filled('tanggal_pinjam') && $this->filled('tanggal_kembali') && strtotime($value) < strtotime($this->tanggal_pinjam)) {
                        $fail('Tanggal kembali harus sama atau setelah tanggal pinjam.');
                    }
                },
            ],
            'status' => ['sometimes', 'required', 'in:dipinjam,dikembalikan'],
        ];
    }
}
