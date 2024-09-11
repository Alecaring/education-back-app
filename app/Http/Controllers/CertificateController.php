<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::with('user', 'course')->get();
        return view('certificates.index', compact('certificates'));
    }

    public function create()
    {
        $users = User::all();
        $courses = Course::all();
        return view('certificates.create', compact('users', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'issued_at' => 'required|date',
            'expires_at' => 'required|date|after:issued_at',
        ]);

        Certificate::create($request->all());

        return redirect()->route('certificates.index')->with('success', 'Certificate created successfully.');
    }

    public function show(Certificate $certificate)
    {
        return view('certificates.show', compact('certificate'));
    }

    public function edit(Certificate $certificate)
    {
        $users = User::all();
        $courses = Course::all();
        return view('certificates.edit', compact('certificate', 'users', 'courses'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'issued_at' => 'required|date',
            'expires_at' => 'required|date|after:issued_at',
        ]);

        $certificate->update($request->all());

        return redirect()->route('certificates.index')->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return redirect()->route('certificates.index')->with('success', 'Certificate deleted successfully.');
    }
}
