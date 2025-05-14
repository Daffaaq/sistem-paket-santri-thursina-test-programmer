<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaketRequest extends FormRequest
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
            'nama_paket' => 'required|string|max:100',
            'tanggal_diterima' => 'required|date',
            'id_kategori' => 'required|exists:kategori_pakets,id_kategori',
            'penerima_paket' => 'required|string|exists:santris,nis|max:100',
            'pengirim_paket' => 'required|string|max:100',
            'isi_paket_yang_disita' => 'nullable|string|max:200',
            'status_paket' => 'required|in:Diambil,Belum Diambil',
        ];
    }
}
