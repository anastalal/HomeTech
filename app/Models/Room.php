<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'height',
        'width',
        'devices',
        'plan_id',
        'content',
        'generated'
    ];
    protected $casts = [
        'devices' => 'array',
    ];

    public function plan(){
        return $this->belongsTo(Plan::class);
    }
}
