<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vaccine extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public static $searchable = [
        'vaccination_date',
    ];

    public function cows() : BelongsToMany
    {
        return $this->belongsToMany(Cow::class);
    }

    // public function nextVaccinationDate() : Attribute
    // {
    //     return Attribute::make(
    //         get: fn($value, $attributes) => $attributes['vaccination_date']
    //     );
    // }

    // public function getNextVaccinationDateAttribute()
    // {

    //     $date = Carbon::createFromFormat('Y-m-d', $this->vaccination_date, 'Asia/Dhaka');
    //     $daysToAdd = 4;
    //     $date = $date->addDays(1);
    //     return  $date->format('Y-m-d');
    // }
}
