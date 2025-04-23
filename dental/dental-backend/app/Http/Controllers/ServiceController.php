<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('doctors')->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        $doctors = \App\Models\Doctor::all();
        return view('services.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'doctor_ids' => 'required|array', // Validate that doctor_ids is an array
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Save the service
        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->file('icon') ? $request->file('icon')->store('services', 'public') : null,
        ]);

        // Attach doctors to the service
        $service->doctors()->sync($request->doctor_ids);

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }

    public function show($id)
    {
        $service = Service::with('doctor')->findOrFail($id);
        return view('services.show', compact('service'));
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $doctors = \App\Models\Doctor::all();
        return view('services.edit', compact('service', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'doctor_ids' => 'required|array', // Validate that doctor_ids is an array
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Find the service
        $service = Service::findOrFail($id);

        // Check if a new image is uploaded
        if ($request->hasFile('icon')) {
            // Delete the old image if it exists
            if ($service->icon && Storage::disk('public')->exists($service->icon)) {
                Storage::disk('public')->delete($service->icon);
            }

            // Store the new image
            $iconPath = $request->file('icon')->store('services', 'public');
        } else {
            // Keep the old image if no new image is uploaded
            $iconPath = $service->icon;
        }

        // Update the service
        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $iconPath,
        ]);

        // Sync doctors with the service
        $service->doctors()->sync($request->doctor_ids);

        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        if ($service->icon && Storage::disk('public')->exists($service->icon)) {
            Storage::disk('public')->delete($service->icon);
        }
        $service->delete();

        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
