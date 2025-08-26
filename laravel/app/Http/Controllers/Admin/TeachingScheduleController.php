<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassSection;
use App\Models\TeachingSchedule;
use Illuminate\Http\Request;

class TeachingScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager']);
    }

    public function index()
    {
        $schedules = TeachingSchedule::with('classSection')->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $classSections = ClassSection::all();
        return view('admin.schedules.create', compact('classSections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_section_id' => 'required|exists:class_sections,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'room' => 'required',
            'content' => 'required',
            'status' => 'required|in:dang_day,nghi,day_bu,hoan_thanh',
        ]);

        TeachingSchedule::create($validated);
        return redirect()->route('admin.schedules.index')->with('success', 'Tạo lịch giảng dạy thành công');
    }

    public function edit(TeachingSchedule $schedule)
    {
        $classSections = ClassSection::all();
        return view('admin.schedules.edit', compact('schedule', 'classSections'));
    }

    public function update(Request $request, TeachingSchedule $schedule)
    {
        $validated = $request->validate([
            'class_section_id' => 'required|exists:class_sections,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'room' => 'required',
            'content' => 'required',
            'status' => 'required|in:dang_day,nghi,day_bu,hoan_thanh',
        ]);

        $schedule->update($validated);
        return redirect()->route('admin.schedules.index')->with('success', 'Cập nhật lịch giảng dạy thành công');
    }

    public function destroy(TeachingSchedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Xóa lịch giảng dạy thành công');
    }
}