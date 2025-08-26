<!DOCTYPE html>
<html>
<head>
    <title>Bảng Điều Khiển Quản Trị</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Bảng Điều Khiển Quản Trị</h1>
        <p>Số người dùng: {{ $stats['users'] }}</p>
        <p>Số môn học: {{ $stats['courses'] }}</p>
        <p>Số lớp học phần: {{ $stats['class_sections'] }}</p>
        <p>Số lịch giảng dạy: {{ $stats['schedules'] }}</p>
        <a href="{{ route('admin.users.index') }}">Quản lý người dùng</a>
        <a href="{{ route('admin.courses.index') }}">Quản lý môn học</a>
        <a href="{{ route('admin.class_sections.index') }}">Quản lý lớp học phần</a>
        <a href="{{ route('admin.schedules.index') }}">Quản lý lịch giảng dạy</a>
        <a href="{{ route('admin.schedule_changes.index') }}">Quản lý thay đổi lịch</a>
        <a href="{{ route('admin.teaching_logs.index') }}">Quản lý nhật ký giảng dạy</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Đăng xuất</button>
        </form>
    </div>
</body>
</html>