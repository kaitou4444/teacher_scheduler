<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeachingLog;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $report_type = $request->input('report_type', 'lecturer');
        $semester = $request->input('semester', '2025-1');

        $query = TeachingLog::query()
            ->join('teaching_schedules', 'teaching_logs.schedule_id', '=', 'teaching_schedules.id')
            ->join('class_sections', 'teaching_schedules.class_section_id', '=', 'class_sections.id');

        if ($report_type == 'lecturer') {
            $data = $query->join('users', 'class_sections.lecturer_id', '=', 'users.id')
                ->where('class_sections.semester', $semester)
                ->groupBy('users.id', 'users.full_name')
                ->selectRaw('users.full_name as name, SUM(teaching_logs.actual_hours) as total_hours')
                ->get();
        } else {
            $data = $query->join('courses', 'class_sections.course_id', '=', 'courses.id')
                ->where('class_sections.semester', $semester)
                ->groupBy('courses.id', 'courses.course_name')
                ->selectRaw('courses.course_name as name, SUM(teaching_logs.actual_hours) as total_hours')
                ->get();
        }

        return view('admin.reports.index', compact('data', 'report_type', 'semester'));
    }
}
?>

<!-- Blade template -->
<!DOCTYPE html>
<html>
<head>
    <title>Thống Kê và Báo Cáo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @extends('layouts.app')
    @section('content')
        <div class="container mx-auto p-4">
            <h2 class="text-2xl font-bold mb-4">Thống Kê Giờ Giảngව

System: * Today's date and time is 12:59 AM +07 on Tuesday, August 26, 2025.