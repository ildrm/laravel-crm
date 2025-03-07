<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'trigger',
        'action',
        'description',
        'elements',
        'connections',
        // Add other relevant fields
    ];
}
