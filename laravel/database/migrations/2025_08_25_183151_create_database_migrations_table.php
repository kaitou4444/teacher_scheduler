<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Bảng users: Hỗ trợ 3 vai trò (student, teacher, manager)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('password'); // Hash password cho tất cả vai trò
            $table->string('api_token', 80)->nullable()->unique();
            $table->enum('role', ['student', 'teacher', 'manager']);
            $table->string('full_name', 100);
            $table->string('email', 100)->unique();
            $table->timestamps();
        });

        // Bảng courses: Môn học
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code', 20)->unique();
            $table->string('course_name', 100);
            $table->integer('credits');
            $table->timestamps();
        });

        // Bảng class_sections: Lớp học phần
        Schema::create('class_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_code', 20)->unique();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->foreignId('lecturer_id')->constrained('users')->onDelete('cascade');
            $table->string('semester', 20);
            $table->timestamps();
        });

        // Bảng teaching_schedules: Lịch dạy
        Schema::create('teaching_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_section_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('room', 50);
            $table->text('content');
            $table->enum('status', ['dang_day', 'nghi', 'day_bu', 'hoan_thanh'])->default('dang_day');
            $table->timestamps();
        });

        // Bảng schedule_changes: Thay đổi lịch
        Schema::create('schedule_changes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('teaching_schedules')->onDelete('cascade');
            $table->enum('change_type', ['nghi', 'day_bu']);
            $table->text('reason');
            $table->date('new_date')->nullable();
            $table->time('new_start_time')->nullable();
            $table->time('new_end_time')->nullable();
            $table->string('new_room', 50)->nullable();
            $table->timestamps();
        });

        // Bảng teaching_logs: Ghi nhận giờ giảng
        Schema::create('teaching_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained('teaching_schedules')->onDelete('cascade');
            $table->float('actual_hours');
            $table->foreignId('confirmed_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('confirmed_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_logs');
        Schema::dropIfExists('schedule_changes');
        Schema::dropIfExists('teaching_schedules');
        Schema::dropIfExists('class_sections');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('users');
    }
};
