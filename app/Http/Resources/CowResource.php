<?php

namespace App\Http\Resources;

use App\Models\Cow;
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
        //print_r($this->father);
        return [
            'id' => $this->id,
            'ear_tag_no' => $this->ear_tag_no,
            'name' => $this->name,
            'gender' => $this->gender,
            'status' => $this->status,
            'date_of_birth' => $this->date_of_birth,
            'extra_info' => $this->extra_info,
            'purchase_price' => $this->purchase_price,
            'purchase_date' => $this->purchase_date,
            'mother' =>  new CowResourceSimple($this->mother),
            'children' => CowResourceSimple::collection($this->children),
            'father' => new BreedingBullResource($this->father),
            'vaccines' => VaccineResourceSimple::collection($this->vaccines),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

}
