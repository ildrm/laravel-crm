<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Name of the role
        'guard_name', // Guard name for the role
    ];

    // Define any relationships or methods as needed
}
