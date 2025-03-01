<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'age',
        'address',
        'contact',
        'household_number',
        'status',
        'gender',
        'civil_status',
        'occupation',
        'email_address',
        'birth_date',
        'birth_place',
        'nationality',
        'religion',
        'voter_status',
    ];

    public static $civilStatusOptions = [
        'Single',
        'Married',
        'Widowed',
        'Divorced',
    ];
}

