<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // السماح بالإسناد الجماعي لهذه الحقول
    protected $fillable = ['username','name','age','email','password'];

    // إخفاء الحقول الحساسة من JSON
    protected $hidden = ['password','remember_token'];

    // كاستات جاهزة
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
