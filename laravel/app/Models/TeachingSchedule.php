<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingSchedule extends Model
{
    protected $fillable = ['class_section_id', 'date', 'start_time', 'end_time', 'room', 'content', 'status'];

    protected $casts = [
        'status' => 'string',
    ];

    // Định nghĩa mối quan hệ: Lịch dạy thuộc về một lớp học phần
    public function classSection()
    {
        return $this->belongsTo(ClassSection::class);
    }

    // Định nghĩa mối quan hệ: Lịch dạy có nhiều thay đổi lịch
    public function scheduleChanges()
    {
        return $this->hasMany(ScheduleChange::class);
    }

    // Định nghĩa mối quan hệ: Lịch dạy có nhiều bản ghi giờ giảng
    public function teachingLogs()
    {
        return $this->hasMany(TeachingLog::class);
    }
}