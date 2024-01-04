<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cow extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public static $searchable = [
        'ear_tag_no',
        'name',
    ];

    public function vaccines() : BelongsToMany
    {
        return $this->belongsToMany(Vaccine::class);
    }
}
