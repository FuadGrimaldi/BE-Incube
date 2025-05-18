<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Helpers\ResponseCostum;

class AddressRequest extends FormRequest
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
            'id_user' => 'integer|exists:users,id',
            'Kecamatan' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'Kabupaten' => 'required|string|max:255',
            'Kelurahan' => 'required|string|max:255',
            'Kode_pos' => 'required|string|max:10',
            'alamat_lengkap' => 'required|string|max:255',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, ResponseCostum::error($validator->errors(),null,422));

    }
}
