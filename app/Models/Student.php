<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'date_of_birth',
        'gender',
        'type',
        'status',
        'description',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'status' => 'boolean',
    ];
}
