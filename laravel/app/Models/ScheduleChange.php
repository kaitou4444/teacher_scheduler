<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleChange extends Model
{
    protected $fillable = ['schedule_id', 'change_type', 'reason', 'new_date', 'new_start_time', 'new_end_time', 'new_room'];

    protected $casts = [
        'change_type' => 'string',
    ];

    // Định nghĩa mối quan hệ: Thay đổi lịch thuộc về một lịch dạy
    public function schedule()
    {
        return $this->belongsTo(TeachingSchedule::class, 'schedule_id');
    }
}