<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'thumbnail',
        'name_kh',
        'name_en',
        'short_description',
        'description',
        'total_hours',
        'price',
        'course_category_id',
        'trainner_id',
        'ordering',
        'created_by',
    ];
}
