<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ApiCoursesPageController extends Controller
{
    public function index()
    {
        $corsi = Course::with('user')->get();

        return response()->json($corsi);
    }

    public function show($id)
    {
        // Trova il corso con l'ID specificato e include l'utente associato
        $corso = Course::with('user', 'modules')->find($id);

        if (!$corso) {
            return response()->json(['error' => 'Corso non trovato.'], 404);
        }

        // Restituisci il corso e i moduli associati in formato JSON
        return response()->json([
            'corso' => $corso,
            'moduli' => $corso->modules
        ]);
    }

    public function showMaterials($id)
    {
        $modulo = Module::find($id);

        if (!$modulo) {
            return response()->json(['error' => 'Modulo non trovato.'], 404);
        }

        $materiale = $modulo->materials;

        // Restituisci il modulo e i materiali associati in formato JSON
        return response()->json(['modulo' => $modulo, 'materiali' => $materiale]);
    }
}
