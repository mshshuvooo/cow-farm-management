<?php

namespace App\Http\Requests;

use App\Enum\VaccineDoseEnum;
use App\Enum\VaccineTypeEnum;
use App\Models\Vaccine;
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
            'vaccination_date' => [
                'required', 'date', 'before:tomorrow',
                Rule::unique('vaccines', 'vaccination_date')
                ->where(function ($query) {
                    $query->where('vaccination_date', $this->input('vaccination_date'))
                    ->where('next_vaccination_date', $this->input('next_vaccination_date'))
                    ->where('vaccine_type', $this->input('vaccine_type'))
                    ->where('dose', $this->input('dose'))
                    ->whereHas('cows', function($query)  {
                        $query->whereIn('id', $this->input('cows'));
                    })->get();
                }),],

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
