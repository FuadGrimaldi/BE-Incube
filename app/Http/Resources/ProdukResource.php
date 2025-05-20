<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'nama'       => $this->nama,
            'tinggi'     => $this->tinggi,
            'lebar'      => $this->lebar,
            'kapasitas'  => $this->kapasitas,
            'telur'      => $this->telur,
            'pass_access'=> $this->pass_access,
            'price'      => $this->price,
            'active'     => $this->active,
            'image'      => $this->image,
        ];
    }
}
