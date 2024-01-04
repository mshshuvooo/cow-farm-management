<?php

namespace App\Models;

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
}
