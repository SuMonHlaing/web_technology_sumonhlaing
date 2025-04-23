<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'doctor_id',
        'full_name',
        'email',
        'phone',
        'preferred_date',
        'preferred_time',
        'notes',
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
