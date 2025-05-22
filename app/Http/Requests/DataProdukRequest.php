<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataProdukRequest extends FormRequest
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
            'id_produk' => ['required', 'integer', 'exists:produks,id'],
            'suhu'      => ['required', 'numeric'],
            'humid'     => ['required', 'numeric'],
            'gas'       => ['required', 'numeric'],
            'fan'       => ['required', 'in:ON,OFF'],
            'lampu'     => ['required', 'in:ON,OFF'],
        ];
    }
}
