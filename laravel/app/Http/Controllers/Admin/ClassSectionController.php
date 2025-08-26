<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ClassSection;
use App\Models\User;
use Illuminate\Http\Request;

class ClassSectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager']);
    }

    public function index()
    {
        $classSections = ClassSection::with(['course', 'lecturer'])->get();
        return view('admin.class_sections.index', compact('classSections'));
    }

    public function create()
    {
        $courses = Course::all();
        $lecturers = User::where('role', 'teacher')->get();
        return view('admin.class_sections.create', compact('courses', 'lecturers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section_code' => 'required|unique:class_sections,section_code',
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:users,id',
            'semester' => 'required',
        ]);

        ClassSection::create($validated);
        return redirect()->route('admin.class_sections.index')->with('success', 'Tạo lớp học phần thành công');
    }

    public function edit(ClassSection $classSection)
    {
        $courses = Course::all();
        $lecturers = User::where('role', 'teacher')->get();
        return view('admin.class_sections.edit', compact('classSection', 'courses', 'lecturers'));
    }

    public function update(Request $request, ClassSection $classSection)
    {
        $validated = $request->validate([
            'section_code' => 'required|unique:class_sections,section_code,' . $classSection->id,
            'course_id' => 'required|exists:courses,id',
            'lecturer_id' => 'required|exists:users,id',
            'semester' => 'required',
        ]);

        $classSection->update($validated);
        return redirect()->route('admin.class_sections.index')->with('success', 'Cập nhật lớp học phần thành công');
    }

    public function destroy(ClassSection $classSection)
    {
        $classSection->delete();
        return redirect()->route('admin.class_sections.index')->with('success', 'Xóa lớp học phần thành công');
    }
}