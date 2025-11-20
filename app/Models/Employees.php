<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
    use HasFactory;
    use SoftDeletes;

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
