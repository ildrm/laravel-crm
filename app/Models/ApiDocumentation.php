<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiDocumentation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'endpoint',
        'method',
        'parameters',
        'response',
    ];
}
