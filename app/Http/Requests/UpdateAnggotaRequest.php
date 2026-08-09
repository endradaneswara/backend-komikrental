<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAnggotaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'sometimes|required|string|max:255',
            'no_hp' => ['sometimes', 'required', 'string', 'max:15', 'regex:/^(?:\+62|08)8[1-9][0-9]{6,9}$/'],
            'alamat' => 'sometimes|required|string',
            'tanggal_daftar' => 'sometimes|required|date|before_or_equal:today',
        ];
    }
}
