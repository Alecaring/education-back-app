<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'user_id',
        'file_url',
        'description',
        'completed'
    ];

    // Define the relationship with the Module model
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
