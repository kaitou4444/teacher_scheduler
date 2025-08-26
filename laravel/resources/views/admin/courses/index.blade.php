<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ClassSection;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $sections = ClassSection::with(['course', 'lecturer'])->get();
        $lecturers = User::where('role', 'teacher')->get();
        return view('admin.courses.index', compact('courses', 'sections', 'lecturers'));
    }

    public function store(Request $request)
    {
        if ($request->has('course_code')) {
            $request->validate([
                'course_code' => 'required|unique:courses',
                'course_name' => 'required',
                'credits' => 'required|integer',
            ]);
            Course::create($request->only(['course_code', 'course_name', 'credits']));
            return redirect()->route('courses.index')->with('success', 'Môn học đã thêm!');
        } else {
            $request->validate([
                'section_code' => 'required|unique:class_sections',
                'course_id' => 'required|exists:courses,id',
                'lecturer_id' => 'required|exists:users,id',
                'semester' => 'required',
            ]);
            ClassSection::create($request->only(['section_code', 'course_id', 'lecturer_id', 'semester']));
            return redirect()->route('courses.index')->with('success', 'Lớp học phần đã thêm!');
        }
    }
}
?>

<!-- Blade template -->
<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Môn Học và Lớp Học Phần</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @extends('layouts.app')
    @section('content')
        <div class="container mx-auto p-4">
            <h2 class="text-2xl font-bold mb-4">Quản Lý Môn Học và Lớp Học Phần</h2>
            @if (session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">{{ session('success') }}</div>
            @endif
            <h3 class="text-xl font-semibold mb-2">Thêm Môn Học</h3>
            <form method="POST" action="{{ route('courses.store') }}" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Mã Môn</label>
                    <input type="text" name="course_code" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Tên Môn</label>
                    <input type="text" name="course_name" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Số Tín Chỉ</label>
                    <input type="number" name="credits" class="w-full p-2 border rounded" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Thêm Môn</button>
            </form>
            <h3 class="text-xl font-semibold mb-2">Thêm Lớp Học Phần</h3>
            <form method="POST" action="{{ route('courses.store') }}" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Mã Lớp</label>
                    <input type="text" name="section_code" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Môn Học</label>
                    <select name="course_id" class="w-full p-2 border rounded" required>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Giảng Viên</label>
                    <select name="lecturer_id" class="w-full p-2 border rounded" required>
                        @foreach ($lecturers as $lecturer)
                            <option value="{{ $lecturer->id }}">{{ $lecturer->full_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Học Kỳ</label>
                    <input type="text" name="semester" class="w-full p-2 border rounded" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Thêm Lớp</button>
            </form>
            <h3 class="text-xl font-semibold mb-2">Danh Sách Lớp Học Phần</h3>
            <table class="w-full border-collapse border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">Mã Lớp</th>
                        <th class="border p-2">Môn Học</th>
                        <th class="border p-2">Giảng Viên</th>
                        <th class="border p-2">Học Kỳ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                        <tr>
                            <td class="border p-2">{{ $section->section_code }}</td>
                            <td class="border p-2">{{ $section->course->course_name }}</td>
                            <td class="border p-2">{{ $section->lecturer->full_name }}</td>
                            <td class="border p-2">{{ $section->semester }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</body>
</html>