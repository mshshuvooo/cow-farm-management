<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\ValidationFailedException;



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
            'ear_tag_no' => 'required|max:10|unique:cows',
            'name' => 'required|max:25|unique:cows',
            'gender' => 'required|max:10',
            'date_of_birth' => 'nullable|date',
            'prev_owner_info' => 'nullable|max:30',
            'purchase_price' => 'nullable|max:10',
            'purchase_date' => 'nullable|date',
            'mother_name' => 'nullable|max:25',
            'father_bull_no' => 'nullable|max:10',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationFailedException(json_encode($validator->errors()->all()));
    }
}
