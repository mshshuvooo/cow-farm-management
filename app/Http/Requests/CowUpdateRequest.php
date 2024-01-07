<?php

namespace App\Http\Requests;

use App\Enum\CowGenderEnum;
use App\Enum\CowStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CowUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "ear_tag_no" => ["sometimes", "string", "max:10", "unique:cows,ear_tag_no,{$this->cow->id}"],
            "name" => ["sometimes", "string", "max:25", "unique:cows"],
            "gender" => [
                "sometimes",
                "string",
                new Enum(CowGenderEnum::class)
            ],
            "status" => [
                "sometimes",
                "string",
                new Enum(CowStatusEnum::class)
            ],
            "date_of_birth" => ["sometimes", "date"],
            "prev_owner_info" => ["sometimes", "string", "max:500"],
            "purchase_price" => ["sometimes", "numeric"],
            "purchase_date" => ["sometimes", "date"],
            "mother_id" => [
                "sometimes",
                "numeric",
                Rule::exists("cows", "id")->where("gender", CowGenderEnum::FEMALE->value)
            ],
            "father" => ["sometimes", "string"],
        ];
    }
}
