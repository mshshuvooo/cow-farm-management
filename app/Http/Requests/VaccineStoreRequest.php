<?php

namespace App\Http\Requests;

use App\Enum\VaccineDoseEnum;
use App\Enum\VaccineTypeEnum;
use App\Models\Vaccine;
use App\Rules\UniqueVaccine;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
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
            'vaccination_date' => [
                'required', 'date', 'before:tomorrow', new UniqueVaccine($this->all())
            ],

            'next_vaccination_date' => ['required', 'date', 'after:vaccination_date'],

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
