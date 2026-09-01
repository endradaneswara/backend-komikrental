<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKomikRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => ['sometimes', 'required', 'string', 'max:255'],
            'penulis' => ['sometimes', 'required', 'string', 'max:255'],
            'kategori_id' => ['sometimes', 'required', 'integer', 'exists:kategori,id'],
            'stok' => ['sometimes', 'required', 'integer', 'min:0'],
            'status' => ['sometimes', 'in:available,unavailable'],
            'file_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
        ];
    }
}
