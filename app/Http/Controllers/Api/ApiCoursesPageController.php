<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ApiCoursesPageController extends Controller
{
    public function index() {
        $corsi = Course::all();

        // Restituisci i corsi in formato JSON
        return response()->json($corsi);
    }

    public function show($id) {
        $corso = Course::find($id);

        if (!$corso) {
            return response()->json(['error' => 'Corso non trovato.'], 404);
        }

        $moduli = $corso->modules;

        // Restituisci il corso e i moduli associati in formato JSON
        return response()->json(['corso' => $corso, 'moduli' => $moduli]);
    }

    public function showMaterials($id) {
        $modulo = Module::find($id);

        if (!$modulo) {
            return response()->json(['error' => 'Modulo non trovato.'], 404);
        }

        $materiale = $modulo->materials;

        // Restituisci il modulo e i materiali associati in formato JSON
        return response()->json(['modulo' => $modulo, 'materiali' => $materiale]);
    }
}
