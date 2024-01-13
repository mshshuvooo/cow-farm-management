<?php

namespace App\Http\Requests;

use App\Enum\CowGenderEnum;
use App\Enum\CowStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\ValidationFailedException;
use App\Models\Cow;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CowStoreRequest extends FormRequest
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
            'ear_tag_no' => ['required', 'string', 'max:10', 'unique:cows'],
            'name' => ['required', 'string', 'max:25', 'unique:cows'],
            'gender' => [
                'required',
                'string',
                new Enum(CowGenderEnum::class)
            ],
            'status' => [
                'required',
                'string',
                new Enum(CowStatusEnum::class)
            ],
            'date_of_birth' => ['nullable', 'date'],
            'extra_info' => ['nullable', 'string', 'max:500'],
            'purchase_price' => ['nullable', 'numeric', 'max:1000000'],
            'purchase_date' => ['nullable', 'date'],
            'mother_id' => [
                'nullable',
                'numeric',
                Rule::exists('cows', 'id')->where('gender', CowGenderEnum::FEMALE->value)
            ],
            'father' => ['nullable', 'string'],
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     throw new ValidationFailedException(json_encode($validator->errors()->all()));
    // }





}
