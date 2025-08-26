<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeachingSchedule;
use App\Models\TeachingLog;
use App\Models\User;
use Illuminate\Http\Request;

class TeachingLogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager']);
    }

    public function index()
    {
        $teachingLogs = TeachingLog::with(['teachingSchedule', 'confirmedBy'])->get();
        return view('admin.teaching_logs.index', compact('teachingLogs'));
    }

    public function create()
    {
        $schedules = TeachingSchedule::all();
        $managers = User::where('role', 'manager')->get();
        return view('admin.teaching_logs.create', compact('schedules', 'managers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:teaching_schedules,id',
            'actual_hours' => 'required|numeric|min:0',
            'confirmed_by' => 'required|exists:users,id',
        ]);

        TeachingLog::create($validated);
        return redirect()->route('admin.teaching_logs.index')->with('success', 'Tạo nhật ký giảng dạy thành công');
    }

    public function edit(TeachingLog $teachingLog)
    {
        $schedules = TeachingSchedule::all();
        $managers = User::where('role', 'manager')->get();
        return view('admin.teaching_logs.edit', compact('teachingLog', 'schedules', 'managers'));
    }

    public function update(Request $request, TeachingLog $teachingLog)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:teaching_schedules,id',
            'actual_hours' => 'required|numeric|min:0',
            'confirmed_by' => 'required|exists:users,id',
        ]);

        $teachingLog->update($validated);
        return redirect()->route('admin.teaching_logs.index')->with('success', 'Cập nhật nhật ký giảng dạy thành công');
    }

    public function destroy(TeachingLog $teachingLog)
    {
        $teachingLog->delete();
        return redirect()->route('admin.teaching_logs.index')->with('success', 'Xóa nhật ký giảng dạy thành công');
    }
}