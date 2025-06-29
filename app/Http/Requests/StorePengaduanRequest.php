<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaduanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_pelapor' => 'required|string|max:255',
            'email' => 'required|email',
            'tanggal_pengaduan' => 'required|date',
            'jenis_kerusakan' => 'required|string',
            'lokasi_kerusakan' => 'required|string',
            'foto_kerusakan' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
