<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index () {
        $corsi = Course::all();

        return view('test.index', compact('corsi'));
    }


    public function show ($id) {
        $corso = Course::find($id);

        if (!$corso) {
            abort(404, "Corso non trovat000o.");
        }

        $moduli = $corso->modules;

        return view('test.show', compact('corso', 'moduli'));
    }

    public function showMaterials($id) {
        $modulo = Module::find($id);

        $materiale = $modulo->materials;

        return view('test.showMaterials', compact('modulo', 'materiale'));
    }
}
