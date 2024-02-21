<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchDateRequest extends FormRequest
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
        return [
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }
    public function messages(): array
    {
        return [
            'start_date.nullable' => 'Tanggal awal tidak boleh kosong.',
            'start_date.date' => 'Tanggal harus ber type date.',
            'end_date.nullable' => 'Tanggal awal tidak boleh kosong.',
            'end_date.date' => 'Tanggal harus ber type date.',
            'end_date.after_or_equal' => 'tanggal awal tidak boleh melebihi tanggal akhir.',
        ];
    }
}
