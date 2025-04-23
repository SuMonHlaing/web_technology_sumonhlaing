<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'experience' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'location' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'certifications' => 'nullable|string',
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('doctors', 'public');
        }

        Doctor::create([
            'name' => $request->name,
            'experience' => $request->experience,
            'phone' => $request->phone,
            'email' => $request->email,
            'location' => $request->location,
            'working_hours' => $request->working_hours,
            'certifications' => $request->certifications,
            'about' => $request->about,
            'image' => $imagePath,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor created successfully!');
    }
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.show', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.edit', compact('doctor'));
    }
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'experience' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'location' => 'nullable|string|max:255',
            'working_hours' => 'nullable|string|max:255',
            'certifications' => 'nullable|string',
            'about' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imagePath = $doctor->image;

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            // Store new image
            $imagePath = $request->file('image')->store('doctors', 'public');
        }

        // Update doctor
        $doctor->update([
            'name' => $request->name,
            'experience' => $request->experience,
            'phone' => $request->phone,
            'email' => $request->email,
            'location' => $request->location,
            'working_hours' => $request->working_hours,
            'certifications' => $request->certifications,
            'about' => $request->about,
            'image' => $imagePath,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully!');
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        // Delete the image if exists
        if ($doctor->image && Storage::disk('public')->exists($doctor->image)) {
            Storage::disk('public')->delete($doctor->image);
        }

        $doctor->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully!');
    }
}
