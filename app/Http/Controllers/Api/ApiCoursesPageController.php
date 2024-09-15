<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
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
        $corso = Course::with(['user', 'modules.materials'])->find($id);


        if (!$corso) {
            return response()->json(['error' => 'Corso non trovato.'], 404);
        }

        return response()->json([
            'corso' => $corso,
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

    public function updateStatus(Request $request, $id)
    {

        // Trova il materiale e aggiorna il suo stato
        $material = Material::findOrFail($id);
        $material->completed = $request->input('completed');
        $material->save();

        // Trova il modulo a cui appartiene il materiale
        $module = Module::findOrFail($material->module_id);

        // Controlla se tutti i materiali del modulo sono completati
        $allMaterialsCompleted = $module->materials->every(function ($material) {
            return $material->completed;
        });

        // Aggiorna lo stato del modulo se tutti i materiali sono completati
        if ($allMaterialsCompleted) {
            $module->completed = true;
            $module->save();
        }

        return response()->json([
            'material' => $material,
            'module' => $module
        ]);
    }
}
