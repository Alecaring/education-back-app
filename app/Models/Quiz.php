<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function quizQuestion() {
        return $this->hasMany(QuizQuestion::class);
    }
}
