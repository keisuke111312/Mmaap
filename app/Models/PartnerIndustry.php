<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerIndustry extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'logo_url', 'description','type'];
}
