<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Lịch Giảng Dạy</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-500 p-4 text-white">
        <div class="container mx-auto flex justify-between">
            <h1 class="text-xl font-bold">Quản Lý Lịch Giảng Dạy</h1>
            <div>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="mr-4 hover:underline">Dashboard</a>
                    <a href="{{ route('users.index') }}" class="mr-4 hover:underline">Giảng Viên</a>
                    <a href="{{ route('courses.index') }}" class="mr-4 hover:underline">Môn Học & Lớp</a>
                    <a href="{{ route('schedules.create') }}" class="mr-4 hover:underline">Tạo Lịch</a>
                    <a href="{{ route('schedules.changes') }}" class="mr-4 hover:underline">Nghỉ/Dạy Bù</a>
                    <a href="{{ route('teaching_logs.confirm') }}" class="mr-4 hover:underline">Xác Nhận Giờ</a>
                    <a href="{{ route('reports.index') }}" class="mr-4 hover:underline">Báo Cáo</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:underline">Đăng Xuất</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>
    <main class="container mx-auto py-4">
        @yield('content')
    </main>
</body>
</html>