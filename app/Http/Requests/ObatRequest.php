<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObatRequest extends FormRequest
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
            'nama_obat' => 'required',
            'harga' => 'required|min:1',
            'keterangan' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif',
            'stok' => 'required|min:1',
            'exp' => 'required',
            'kategori' => 'required'
        ];
    }
    public function messages(): array
    {
        return [
            'nama_obat.required' => 'nama_obat wajib di isi',
            'harga.required' => 'wajib di isi',
            'harga.min' => 'stok harus melebihi 0',
            'keterangan.required' => 'keterangan wajib di isi',
            'stok.required' => 'stok wajib di isi',
            'stok.min' => 'stok harus melebihi 0',
            'exp.required' => 'waktu expired wajib di isi',
            'kategori.required' => 'kategori wajib di isi',
            'image.required' => 'Gambar wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari :max kilobita.',
        ];
    }
}
