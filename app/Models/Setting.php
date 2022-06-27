<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'setting';

    protected $casts = [
        'value' => AsArrayObject::class,
    ];

    protected $fillable = [
        'key',
        'value',
    ];
}
