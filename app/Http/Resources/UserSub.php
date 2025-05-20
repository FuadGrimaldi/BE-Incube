<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSub extends JsonResource
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
            'produk' => [
                'id' => $this->produk?->id,
                'nama' => $this->produk?->nama,
                'tinggi' => $this->produk?->tinggi,
                'lebar' => $this->produk?->lebar,
                'kapasitas' => $this->produk?->kapasitas,
                'telur' => $this->produk?->telur,
                'pass_access' => $this->produk?->pass_access,
                'price' => $this->produk?->price,
                'active' => $this->produk?->active,
                'image' => $this->produk?->image,
            ],
            'start_sub' => $this->start_sub,
            'end_sub' => $this->end_sub,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
