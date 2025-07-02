<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialTerm extends Model
{
    use HasFactory;

    public function officials()
    {
        return $this->hasMany(Official::class, 'term_id');
    }
}
