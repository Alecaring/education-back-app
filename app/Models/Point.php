<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'points_gained'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addPoints($userId, $points)
    {
        // Trova o crea un record dei punti per l'utente
        $pointRecord = Point::firstOrCreate(['user_id' => $userId]);

        // Aggiungi i punti
        $pointRecord->points_gained += $points;
        $pointRecord->save();
    }
}
