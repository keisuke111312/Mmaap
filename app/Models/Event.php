<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start',
        'end',
        'user_id',
        'description',
        'start_time',
        'start_ampm',
        'duration',
        'location',
        'reminder',
        'image_path',
        'type',
    ];
    
}
