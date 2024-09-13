<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use App\Models\Point;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    /**
     * Mostra i premi disponibili.
     */
    public function index()
    {
        $rewards = Reward::all();
        return view('rewards.index', ['rewards' => $rewards]);
    }

    /**
     * Controlla i premi che l'utente può riscattare.
     */
    public function checkRewards($userId)
    {
        $userPoints = Point::where('user_id', $userId)->value('points_gained');

        if ($userPoints === null) {
            $userPoints = 0; // Imposta a 0 se i punti non sono trovati
        }

        $rewards = Reward::where('points_required', '<=', $userPoints)->get();

        return view('rewards.check', ['rewards' => $rewards, 'userPoints' => $userPoints]);
    }


    /**
     * Riscatta un premio per l'utente.
     */
    public function redeemReward(Request $request)
    {
        $userId = $request->input('user_id');
        $rewardId = $request->input('reward_id');

        $reward = Reward::find($rewardId);
        if (!$reward) {
            return redirect()->back()->withErrors('Reward not found.');
        }

        $userPoints = Point::where('user_id', $userId)->value('points_gained');
        if ($userPoints < $reward->points_required) {
            return redirect()->back()->withErrors('Not enough points.');
        }

        // Deduct points (optional)
        Point::where('user_id', $userId)->decrement('points_gained', $reward->points_required);

        return redirect()->route('rewards.index')->with('success', 'Reward redeemed successfully.');
    }
}
