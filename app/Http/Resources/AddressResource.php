<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
                'email' => $this->user?->email,
            ],
            'address' => [
                'Kecamatan' => $this->Kecamatan,
                'provinsi' => $this->provinsi,
                'Kabupaten' => $this->Kabupaten,
                'Kelurahan' => $this->Kelurahan,
                'Kode_pos' => $this->Kode_pos,
                'alamat_lengkap' => $this->alamat_lengkap,
            ],
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
