<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeachingSchedule;
use App\Models\ScheduleChange;
use Illuminate\Http\Request;

class ScheduleChangeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager']);
    }

    public function index()
    {
        $scheduleChanges = ScheduleChange::with('teachingSchedule')->get();
        return view('admin.schedule_changes.index', compact('scheduleChanges'));
    }

    public function create()
    {
        $schedules = TeachingSchedule::all();
        return view('admin.schedule_changes.create', compact('schedules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:teaching_schedules,id',
            'change_type' => 'required|in:nghi,day_bu',
            'reason' => 'required',
            'new_date' => 'nullable|date',
            'new_start_time' => 'nullable',
            'new_end_time' => 'nullable|after:new_start_time',
            'new_room' => 'nullable',
        ]);

        ScheduleChange::create($validated);
        return redirect()->route('admin.schedule_changes.index')->with('success', 'Tạo thay đổi lịch thành công');
    }

    public function edit(ScheduleChange $scheduleChange)
    {
        $schedules = TeachingSchedule::all();
        return view('admin.schedule_changes.edit', compact('scheduleChange', 'schedules'));
    }

    public function update(Request $request, ScheduleChange $scheduleChange)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:teaching_schedules,id',
            'change_type' => 'required|in:nghi,day_bu',
            'reason' => 'required',
            'new_date' => 'nullable|date',
            'new_start_time' => 'nullable',
            'new_end_time' => 'nullable|after:new_start_time',
            'new_room' => 'nullable',
        ]);

        $scheduleChange->update($validated);
        return redirect()->route('admin.schedule_changes.index')->with('success', 'Cập nhật thay đổi lịch thành công');
    }

    public function destroy(ScheduleChange $scheduleChange)
    {
        $scheduleChange->delete();
        return redirect()->route('admin.schedule_changes.index')->with('success', 'Xóa thay đổi lịch thành công');
    }
}