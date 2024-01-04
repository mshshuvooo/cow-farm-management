<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function mother() : BelongsTo {
        return $this->belongsTo(Cow::class,'mother_id','id');
    }

    public function children() : HasMany {
        return $this->hasMany(Cow::class,'mother_id','id');
    }
}
