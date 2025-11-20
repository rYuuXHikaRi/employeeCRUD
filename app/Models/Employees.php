<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employees extends Model
{
    use HasFactory;
    protected $table = 'employees';

    protected $fillable = [
        'name',
        'email',
        'position',
        'salary',
        'status',
        'hired_at',
    ];

    protected $casts = [
        'salary' => 'integer',
        'hired_at' => 'date',
    ];
}
