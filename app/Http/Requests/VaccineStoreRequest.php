<?php

namespace App\Http\Requests;

use App\Enum\VaccineDoseEnum;
use App\Enum\VaccineTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class VaccineStoreRequest extends FormRequest
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
            'vaccination_date' => ['required', 'date', 'before:tomorrow'],
            'next_vaccination_date' => ['required', 'date', 'after:today'],
            'vaccine_type' => [
                'required',
                'string',
                new Enum(VaccineTypeEnum::class)
            ],
            'dose' => [
                'required',
                'string',
                new Enum(VaccineDoseEnum::class)
            ],
            'cows' => ['required', 'array', 'min:1', Rule::exists('cows', 'id')],
        ];
    }
}
