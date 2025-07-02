<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'tutor_id',
        'program',
        'subject',
        'day',
        'time',
        'date',
        'status',
    ];

    public function studentUser()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'student_id');
    }


    public function tutorUser()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class, 'user_id', 'tutor_id');
    }


    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }
}

