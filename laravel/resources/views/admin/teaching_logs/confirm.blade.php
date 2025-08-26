<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeachingSchedule;
use App\Models\TeachingLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeachingLogController extends Controller
{
    public function confirm()
    {
        $schedules = TeachingSchedule::with(['class_section.course'])->where('status', '!=', 'hoan_thanh')->get();
        return view('admin.teaching_logs.confirm', compact('schedules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:teaching_schedules,id',
            'actual_hours' => 'required|numeric|min:0',
        ]);

        TeachingLog::create([
            'schedule_id' => $request->schedule_id,
            'actual_hours' => $request->actual_hours,
            'confirmed_by' => Auth::id(),
        ]);

        TeachingSchedule::where('id', $request->schedule_id)->update(['status' => 'hoan_thanh']);
        return redirect()->route('teaching_logs.confirm')->with('success', 'Giờ dạy đã xác nhận!');
    }
}
?>

<!-- Blade template -->
<!DOCTYPE html>
<html>
<head>
    <title>Xác Nhận Giờ Dạy</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @extends('layouts.app')
    @section('content')
        <div class="container mx-auto p-4">
            <h2 class="text-2xl font-bold mb-4">Xác Nhận Giờ Dạy</h2>
            @if (session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('teaching_logs.store') }}" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Buổi Học</label>
                    <select name="schedule_id" class="w-full p-2 border rounded" required>
                        @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}">{{ $schedule->class_section->section_code }} - {{ $schedule->class_section->course->course_name }} - {{ $schedule->date }} - {{ $schedule->room }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Giờ Thực Tế</label>
                    <input type="number" step="0.5" name="actual_hours" class="w-full p-2 border rounded" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Xác Nhận</button>
            </form>
        </div>
    @endsection
</body>
</html>