<?php
   use Illuminate\Support\Facades\Route;
   use App\Http\Controllers\AuthController;
   use App\Http\Controllers\Admin\DashboardController;
   use App\Http\Controllers\Admin\UserController;
   use App\Http\Controllers\Admin\CourseController;
   use App\Http\Controllers\Admin\ClassSectionController;
   use App\Http\Controllers\Admin\TeachingScheduleController;
   use App\Http\Controllers\Admin\ScheduleChangeController;
   use App\Http\Controllers\Admin\TeachingLogController;

   Route::middleware(['auth', 'role:manager'])->prefix('admin')->name('admin.')->group(function () {
       Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
       Route::resource('users', UserController::class);
       Route::resource('courses', CourseController::class);
       Route::resource('class_sections', ClassSectionController::class);
       Route::resource('schedules', TeachingScheduleController::class);
       Route::resource('schedule_changes', ScheduleChangeController::class);
       Route::resource('teaching_logs', TeachingLogController::class);
   });

   Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
   Route::post('/login', [AuthController::class, 'login']);
   Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

