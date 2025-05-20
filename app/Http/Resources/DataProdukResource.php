<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DataProdukResource extends JsonResource
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
            'produk' => [
                'id' => $this->produk?->id,
                'nama' => $this->produk?->nama,
            ],
            'suhu' => $this->suhu,
            'humid' => $this->humid,
            'gas' => $this->gas,
            'lampu' => $this->lampu,
            'fan' => $this->fan,
            'created_at' => $this->created_at,
        ];
    }
}
