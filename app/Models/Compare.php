<?php

namespace App\Models;

use App\Models\User; 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compare extends Model{
    use HasFactory;
    // This is an array specifies which columns of the database can be mass-assigned
    protected $fillable = [
        'device1',
        'device2',
        'content',
        'generated',
        'user_id'
    ];

    // This method defines a relationship where each Compare instance "belongs to" a User 
    // Through a foreign key in the compares table that points to an id in the users table
    public function user(){
        return $this->belongsTo(User::class);
    }
}