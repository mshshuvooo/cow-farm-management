<?php

namespace App\Http\Resources;

use App\Models\Cow;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class BreedingBullResource extends JsonResource
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
            'bull_name' => $this->bull_name,
            'bull_owner' => $this->bull_owner,
            'bull_breed' => $this->bull_breed,

            'children' => CowResourceSimple::collection($this->children),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
