<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSection extends Model
{
    protected $fillable = ['section_code', 'course_id', 'lecturer_id', 'semester'];

    // Định nghĩa mối quan hệ: Lớp học phần thuộc về một môn học
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Định nghĩa mối quan hệ: Lớp học phần thuộc về một giảng viên
    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    // Định nghĩa mối quan hệ: Lớp học phần có nhiều lịch dạy
    public function teachingSchedules()
    {
        return $this->hasMany(TeachingSchedule::class);
    }
}