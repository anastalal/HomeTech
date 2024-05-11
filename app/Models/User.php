<?php

namespace App\Models;

use App\Models\Plan;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable{
    use HasApiTokens, HasFactory, Notifiable;
    // The $fillable array lists the attributes that can be mass assigned safely during the creation or update of a user
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    // Defines a method to send a password reset notification to the user
    public function sendPasswordResetNotification($token){
        $this->notify(new ResetPasswordNotification($token));
    }

    // The $hidden array is used to specify which attributes should be hidden from JSON responses
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // This method specifies one-to-many relationship between User and Plan
    // This allows the user to have multiple plans
    public function plans() :HasMany{
     return $this->hasMany(Plan::class);
    }

    // This method specifies one-to-many relationship between User and Compare
    // This allows the user to have multiple comparisons
    public function compars() :HasMany{
        return $this->hasMany(Compare::class);
       }
}