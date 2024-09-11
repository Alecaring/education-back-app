<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'level',
    ];

    public function module() {

        return $this->hasMany(Module::class);
        
    }

    public function cerificate() {
        
        return $this->hasMany(Certificate::class);
        
    }
}
