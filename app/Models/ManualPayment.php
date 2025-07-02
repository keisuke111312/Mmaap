<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualPayment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'access_level_id' , 'reference_number' , 'screenshot_path' , 'status' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accessLevel()
    {
        return $this->belongsTo(AccessLevel::class);
    }
}
