<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
protected $fillable = [
    'title',
    'company_name',
    'location',
    'type',
    'description',
    'salary_min',
    'salary_max',
    'salary_unit',
    'is_featured',
    'posted_at',
];


public function tags()
{
    return $this->hasMany(JobTags::class, 'job_id');
}




}
