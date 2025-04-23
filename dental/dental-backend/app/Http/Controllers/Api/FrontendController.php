<?php

namespace App\Http\Controllers\Api;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorsResource;
use App\Http\Resources\ServicesResource;
use App\Http\Resources\AppointmentResource;

class FrontendController extends Controller
{

    public function popularDoctors()
    {
        //order by asc
        $doctors = Doctor::orderBy('id', 'desc')->take(3)->get();

        return DoctorsResource::collection($doctors);
    }
    public function doctors()
    {
        //order by asc
        $doctors = Doctor::orderBy('id', 'desc')->get();

        return DoctorsResource::collection($doctors);
    }
    public function popularServices()
    {
        //order by asc
        $services = Service::orderBy('id', 'desc')->take(6)->get();

        return ServicesResource::collection($services);
    }
    public function services()
    {
        //order by asc
        $services = Service::orderBy('id', 'desc')->with('doctor')->get();

        return ServicesResource::collection($services);
    }
    public function showService($id)
    {
        // Attempt to find the service with its associated doctors
        $service = Service::with('doctors')->find($id);

        // Check if the service exists
        if (!$service) {
            return response()->json([
                'error' => 'Data not found',
            ], 404);
        }

        // Return the service as a resource
        return new ServicesResource($service);
    }

    public function showDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        return new DoctorsResource($doctor);
    }
    public function appointment(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'notes' => 'nullable|string|max:255',
        ]);

        $appointment = Appointment::create([
            'user_id' => auth()->id(), // Automatically assign logged-in user's ID
            'doctor_id' => $request->doctor_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'message' => 'Appointment created successfully',
            'appointment' => $appointment,
        ], 201);
    }
    public function appointmentList(Request $request)
    {
        $appointments = Appointment::with('doctor') // optional if you want doctor info
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'appointments' => AppointmentResource::collection($appointments),
        ]);
    }
}
