<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'detail_user' => $this->detail ? [
                'name' => $this->detail->name,
                'age' => $this->detail->age,
                'gender' => $this->detail->gender,
                'contact' => $this->detail->contact,
                'job' => $this->detail->job,
                'profile_picture' => $this->detail->profile_picture,
            ] : null,    
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];   
    }
}
