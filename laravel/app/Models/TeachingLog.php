<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingLog extends Model
{
    protected $fillable = ['schedule_id', 'actual_hours', 'confirmed_by', 'confirmed_at'];

    // Định nghĩa mối quan hệ: Bản ghi giờ giảng thuộc về một lịch dạy
    public function schedule()
    {
        return $this->belongsTo(TeachingSchedule::class, 'schedule_id');
    }

    // Định nghĩa mối quan hệ: Bản ghi giờ giảng được xác nhận bởi một quản trị viên
    public function confirmedBy()
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }
}