<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()

    {
        $appointments = Appointment::with('user')->with('doctor')->get();
        return view('bookings.index', compact('appointments'));
    }
}
