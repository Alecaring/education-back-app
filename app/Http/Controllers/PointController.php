<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{
    /**
     * Mostra i punti dell'utente.
     */
    public function showPoints($userId)
    {
        $points = Point::where('user_id', $userId)->first();

        if (!$points) {
            return view('points.show', ['message' => 'No points found for this user.']);
        }

        return view('points.show', ['points' => $points]);
    }

    // Aggiungi punti all'utente
    public function addPoints($userId, $actionType)
    {
        // Trova l'azione e i punti corrispondenti
        $action = Action::where('action_type', $actionType)->first();
        
        if ($action) {
            $points = $action->points;
            
            // Trova o crea un record dei punti per l'utente
            $pointRecord = Point::firstOrCreate(['user_id' => $userId]);
            
            // Aggiungi i punti
            $pointRecord->points_gained += $points;
            $pointRecord->save();
        }
    }

    // Controlla i punti dell'utente
    public function checkPoints($userId)
    {
        $points = Point::where('user_id', $userId)->value('points_gained');
        return response()->json(['points' => $points]);
    }
}
