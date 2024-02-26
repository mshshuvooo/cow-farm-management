<?php

namespace App\Http\Requests;

use App\Enum\BullBreedEnum;
use App\Enum\BullOwnerEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class BreedingBullUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bull_name' => ['sometimes', 'string', 'max:25', 'unique:breeding_bulls'],
            'bull_owner' => [
                'sometimes',
                'string',
                new Enum(BullOwnerEnum::class)
            ],
            'bull_breed' => [
                'sometimes',
                'string',
                new Enum(BullBreedEnum::class)
            ],
        ];
    }
}
