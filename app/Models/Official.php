<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory;

    protected $fillable = ['title_abbreviation', 'name', 'position_id', 'term_id', 'photo_url', 'bio'];

    public function position()
    {
        return $this->belongsTo(OfficialPosition::class, 'position_id');
    }

    public function term()
    {
        return $this->belongsTo(OfficialTerm::class, 'term_id');
    }
}
