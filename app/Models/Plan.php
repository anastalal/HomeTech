<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model{
    use HasFactory;
    // This is an array specifies which columns of the database can be mass-assigned
    protected $fillable = [
        'name',
        'area',
        'min_budget',
        'max_budget',
        'user_id'
    ]; 

    // This method specifies that each instance of 'Plan' belongs to one 'User'
    // Through a foreign key (user_id) in the plans table
    public function user(){
        return $this->belongsTo(User::class);
    }

    // This method specifies that one Plan can have many Rooms
    public function rooms() :HasMany{
        return $this->hasMany(Room::class);
    }
}