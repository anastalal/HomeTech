<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model{
    use HasFactory;
    // This is an array specifies which columns of the database can be mass-assigned
    protected $fillable = [
        'type',
        'height',
        'width',
        'devices',
        'plan_id',
        'content',
        'generated'
    ];

    // The $casts property helps convert attributes between their database and PHP representations.
    // It's used to convert 'devices' from JSON (in database) to an array (in PHP).
    protected $casts = [
        'devices' => 'array',
    ];

    // This method specifies that each instance of 'Room' belongs to one 'Plan'
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}