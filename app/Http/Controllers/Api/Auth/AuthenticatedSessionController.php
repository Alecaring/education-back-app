<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        // Controlla se l'utente è già autenticato
        if (Auth::check()) {
            $user = Auth::user();
            
            // Verifica se l'utente ha già un token valido
            $existingToken = $user->tokens->first();
            
            if ($existingToken) {
                return response()->json([
                    'token' => $existingToken->token,
                    'user' => $user,
                    'message' => 'User is already logged in.',
                ]);
            }
        }

        // Prova ad autenticare l'utente
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Se non esiste un token, creane uno nuovo
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'No user logged in'], 400);
        }

        Log::info('User logging out', ['user_id' => $user->id]);

        $token = $user->currentAccessToken();
        if ($token) {
            $token->delete();
            Log::info('Token deleted', ['token_id' => $token->id]);
            return response()->json(['message' => 'Logged out successfully']);
        } else {
            Log::warning('No current access token found for user', ['user_id' => $user->id]);
            return response()->json(['error' => 'No token found to delete'], 400);
        }
    }
}
