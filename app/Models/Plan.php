<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'area',
        'min_budget',
        'max_budget',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function rooms() :HasMany{
        return $this->hasMany(Room::class);
       }
}
