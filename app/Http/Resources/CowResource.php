<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CowResource extends JsonResource
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
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'prev_owner_info' => $this->prev_owner_info,
            'purchase_price' => $this->purchase_price,
            'purchase_date' => $this->purchase_date,
            'mother_name' => $this->mother_name,
            'father_bull_no' => $this->father_bull_no,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
