<?php

namespace App\Http\Resources\auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class registerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'email' => $this->email,
            //'password' => $this->password,
            'address' => $this->address,
            'age' => $this->age,
            'gender' => $this->gender,
        ];
    }
}
