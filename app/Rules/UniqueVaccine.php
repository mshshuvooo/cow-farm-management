<?php
// app/Rules/UniqueVaccine.php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Vaccine;

class UniqueVaccine implements Rule
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function passes($attribute, $value)
    {
        $vaccination_date = $this->request['vaccination_date'];
        $next_vaccination_date = $this->request['next_vaccination_date'];
        $vaccine_type = $this->request['vaccine_type'];
        $dose = $this->request['dose'];
        $cows = $this->request['cows'];
        $exists =
        Vaccine::where('vaccination_date', $vaccination_date)
            ->where('next_vaccination_date', $next_vaccination_date)
            ->where('vaccine_type', $vaccine_type)
            ->where('dose', $dose)
            ->where(function ($query) use ($cows) {
                $query->WhereHas('cows', function ($subquery) use ($cows) {
                    $subquery->whereIn('id', $cows);
                });
            })->exists();


        // Return true if the combination is unique, false otherwise
        return !$exists;
    }

    public function message()
    {
        return 'A vaccine with the same combination of information already exists.';
    }
}
