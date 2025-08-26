<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassSection;
use App\Models\ScheduleChange;
use App\Models\TeachingSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function create()
    {
        $sections = ClassSection::with('course')->get();
        return view('admin.schedules.create', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_section_id' => 'required|exists:class_sections,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required',
            'content' => 'required',
        ]);

        TeachingSchedule::create($request->all());
        return redirect()->route('schedules.create')->with('success', 'Lịch dạy đã tạo!');
    }

    public function changes()
    {
        $schedules = TeachingSchedule::with(['class_section.course'])->get();
        return view('admin.schedules.changes', compact('schedules'));
    }

    public function storeChange(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:teaching_schedules,id',
            'change_type' => 'required|in:nghi,day_bu',
            'reason' => 'required',
            'new_date' => 'required_if:change_type,day_bu|date',
            'new_start_time' => 'required_if:change_type,day_bu',
            'new_end_time' => 'required_if:change_type,day_bu',
            'new_room' => 'required_if:change_type,day_bu',
        ]);

        ScheduleChange::create($request->all());
        TeachingSchedule::where('id', $request->schedule_id)->update(['status' => $request->change_type]);
        return redirect()->route('schedules.changes')->with('success', 'Thay đổi đã cập nhật!');
    }
}
?>

<!-- Blade template -->
<!DOCTYPE html>
<html>
<head>
    <title>Tạo Lịch Dạy</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @extends('layouts.app')
    @section('content')
        <div class="container mx-auto p-4">
            <h2 class="text-2xl font-bold mb-4">Tạo Lịch Dạy</h2>
            @if (session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('schedules.store') }}" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Lớp Học Phần</label>
                    <select name="class_section_id" class="w-full p-2 border rounded" required>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->section_code }} - {{ $section->course->course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Ngày</label>
                    <input type="date" name="date" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Bắt Đầu</label>
                    <input type="time" name="start_time" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Kết Thúc</label>
                    <input type="time" name="end_time" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Phòng</label>
                    <input type="text" name="room" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Nội Dung</label>
                    <textarea name="content" class="w-full p-2 border rounded" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Tạo Lịch</button>
            </form>
        </div>
    @endsection
</body>
</html>