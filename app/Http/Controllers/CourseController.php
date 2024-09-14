<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Course not found');
        }

        return view('courses.show', compact('course'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string|in:beginner,intermediate,advanced',
            'coverImgCourses' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,webp|max:2048',
        ]);

        $course = new Course();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->level = $request->level;

        if ($request->hasFile('coverImgCourses')) {
            $file = $request->file('coverImgCourses');
            $file_path = $file->store('coverImgCourses', 'public');
            $course->coverImgCourses = $file_path;
        }

        if (auth()->check()) {
            $course->user_id = auth()->id();
        }

        $course->save();

        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }


    public function edit($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Course not found');
        }

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        // Trova il corso
        $course = Course::find($id);

        // Controlla se il corso esiste
        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Course not found');
        }

        // Validazione dei dati
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'level' => 'required|string|in:beginner,intermediate,advanced',
            'coverImgCourses' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,webp|max:2048',
        ]);

        // Se è stato caricato un file, gestisci l'upload
        if ($request->hasFile('coverImgCourses')) {
            $file = $request->file('coverImgCourses');
            $file_path = $file->store('coverImgCourses', 'public');
            $course->coverImgCourses = $file_path;
        }

        // Aggiorna il corso con i dati del modulo
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->level = $request->input('level');

        // Salva le modifiche
        $course->save();

        // Redirect con messaggio di successo
        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }


    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Course not found');
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }
}
