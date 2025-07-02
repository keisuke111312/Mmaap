<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialPosition extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function officials()
    {
        return $this->hasMany(Official::class, 'position_id');
    }
}
