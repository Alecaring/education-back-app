<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    // Show the form to upload a new material
    public function create()
    {
        $modules = Module::all();

        return view('materials.create', compact('modules'));
    }

    // Store a new material
    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'description' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        // Handle the file upload
        $file = $request->file('file');
        $filePath = $file->store('materials', 'public');

        // Create a new material record
        $material = new Material();
        $material->module_id = $request->module_id;
        $material->user_id = auth()->id();
        $material->file_url = $filePath;
        $material->description = $request->description;
        $material->save();

        return redirect()->route('materials.index')->with('success', 'Material uploaded successfully!');
    }

    // Display a list of all materials
    public function index()
    {
        $materials = Material::latest()->get();
        return view('materials.index', compact('materials'));
    }

    // Show the form to edit an existing material
    public function edit(Material $material)
    {
        return view('materials.edit', compact('material'));
    }

    // Update an existing material
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file')) {
            // Delete the old file
            Storage::disk('public')->delete($material->file_url);

            // Handle the new file upload
            $file = $request->file('file');
            $filePath = $file->store('materials', 'public');

            $material->file_url = $filePath;
        }

        $material->description = $request->description;
        $material->save();

        return redirect()->route('materials.index')->with('success', 'Material updated successfully!');
    }

    // Delete a material
    public function destroy(Material $material)
    {
        // Delete the file
        Storage::disk('public')->delete($material->file_url);

        $material->delete();

        return redirect()->route('materials.index')->with('success', 'Material deleted successfully!');
    }
}
