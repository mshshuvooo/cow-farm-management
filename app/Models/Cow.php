<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cow extends Model
{
    use HasFactory;
    protected $fillable = [
        'ear_tag_no',
        'name',
        'gender',
        'status',
        'date_of_birth',
        'prev_owner_info',
        'purchase_price',
        'purchase_date',
        'mother',
        'father',
    ];

    public static $searchable = [
        'ear_tag_no',
        'name',
    ];
}
