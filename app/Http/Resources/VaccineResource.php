<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VaccineResource extends JsonResource
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
            'vaccination_date' => $this->vaccination_date,
            'next_vaccination_date' => $this->next_vaccination_date,
            'vaccine_type' => $this->vaccine_type,
            'dose' => $this->dose,
            // 'cows' => CowResourceSimple::collection($this->cows),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
