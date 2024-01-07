<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CowResourceSimple extends JsonResource
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
            'ear_tag_no' => $this->ear_tag_no,
            'name' => $this->name,
            'status' => $this->status,
            'gender' => $this->gender,
        ];
    }
}
