<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\ClassSection;
use App\Models\TeachingSchedule;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:manager']);
    }

    public function index()
    {
        $stats = [
            'users' => User::count(),
            'courses' => Course::count(),
            'class_sections' => ClassSection::count(),
            'schedules' => TeachingSchedule::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}