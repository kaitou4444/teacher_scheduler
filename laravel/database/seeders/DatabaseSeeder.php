<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Thêm quản trị viên
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'api_token' => Str::random(60),
            'role' => 'manager',
            'full_name' => 'Quản Trị Viên',
            'email' => 'admin@example.com',
            'created_at' => now(),
        ]);

        // Thêm giảng viên
        DB::table('users')->insert([
            [
                'username' => 'teacher1',
                'password' => Hash::make('teacher123'),
                'api_token' => Str::random(60),
                'role' => 'teacher',
                'full_name' => 'Giảng Viên 1',
                'email' => 'teacher1@example.com',
                'created_at' => now(),
            ],
            [
                'username' => 'teacher2',
                'password' => Hash::make('teacher123'),
                'api_token' => Str::random(60),
                'role' => 'teacher',
                'full_name' => 'Giảng Viên 2',
                'email' => 'teacher2@example.com',
                'created_at' => now(),
            ],
        ]);

        // Thêm sinh viên
        DB::table('users')->insert([
            [
                'username' => 'student1',
                'password' => Hash::make('student123'),
                'api_token' => Str::random(60),
                'role' => 'student',
                'full_name' => 'Sinh Viên 1',
                'email' => 'student1@example.com',
                'created_at' => now(),
            ],
            [
                'username' => 'student2',
                'password' => Hash::make('student123'),
                'api_token' => Str::random(60),
                'role' => 'student',
                'full_name' => 'Sinh Viên 2',
                'email' => 'student2@example.com',
                'created_at' => now(),
            ],
        ]);

        // Thêm môn học
        DB::table('courses')->insert([
            ['course_code' => 'CS101', 'course_name' => 'Lập Trình Cơ Bản', 'credits' => 3, 'created_at' => now()],
            ['course_code' => 'CS102', 'course_name' => 'Cơ Sở Dữ Liệu', 'credits' => 4, 'created_at' => now()],
        ]);

        // Thêm lớp học phần
        DB::table('class_sections')->insert([
            ['section_code' => 'CS101-01', 'course_id' => 1, 'lecturer_id' => 2, 'semester' => '2025-1', 'created_at' => now()],
            ['section_code' => 'CS102-01', 'course_id' => 2, 'lecturer_id' => 3, 'semester' => '2025-1', 'created_at' => now()],
        ]);
    }
}