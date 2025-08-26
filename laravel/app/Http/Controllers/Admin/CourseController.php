<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager']);
    }

    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_code' => 'required|unique:courses,course_code',
            'course_name' => 'required',
            'credits' => 'required|integer|min:1',
        ]);

        Course::create($validated);
        return redirect()->route('admin.courses.index')->with('success', 'Tạo môn học thành công');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_code' => 'required|unique:courses,course_code,' . $course->id,
            'course_name' => 'required',
            'credits' => 'required|integer|min:1',
        ]);

        $course->update($validated);
        return redirect()->route('admin.courses.index')->with('success', 'Cập nhật môn học thành công');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Xóa môn học thành công');
    }
}