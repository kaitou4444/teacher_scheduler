<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course_code', 'course_name', 'credits'];

    // Định nghĩa mối quan hệ: Một môn học có nhiều lớp học phần
    public function classSections()
    {
        return $this->hasMany(ClassSection::class);
    }
}