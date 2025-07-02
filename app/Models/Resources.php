<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resources extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category',
        'title',
        'author',
        'description',
        'tags',
        'file_path',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
