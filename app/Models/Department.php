<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'organization_id',
        'description',
        'head_of_department'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
