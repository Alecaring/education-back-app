<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    protected $primaryKey = 'id';

    protected $fillable = [
        'course_id',
        'title',
        'content',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function quiz() {
        return $this->hasMany(Quiz::class);
    }
}
