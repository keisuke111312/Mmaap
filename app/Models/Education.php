<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = ['school','degree','field_of_study','start_date','end_date', 'grade', 'description', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
