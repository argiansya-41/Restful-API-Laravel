<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHasilPanenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nama_komoditas' => 'required|string|max:255',
            'jumlah_kg' => 'required|numeric|min:1',
        ];

        // API request requires tanggal_panen
        if ($this->expectsJson() || $this->is('api/*')) {
            $rules['tanggal_panen'] = 'required|date';
        } else {
            $rules['tanggal_panen'] = 'nullable|date';
        }

        return $rules;
    }
}
