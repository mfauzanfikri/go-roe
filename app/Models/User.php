<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'role',
        'address',
        'email',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    /**
     * Relasi ke model Tutor.
     */
    public function tutor()
    {
        return $this->hasOne(Tutor::class);
    }
}
