<!-- Blade template -->
<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Nghỉ/Dạy Bù</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @extends('layouts.app')
    @section('content')
        <div class="container mx-auto p-4">
            <h2 class="text-2xl font-bold mb-4">Quản Lý Nghỉ/Dạy Bù</h2>
            @if (session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('schedules.changes') }}" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Buổi Học</label>
                    <select name="schedule_id" class="w-full p-2 border rounded" required>
                        @foreach ($schedules as $schedule)
                            <option value="{{ $schedule->id }}">{{ $schedule->class_section->section_code }} - {{ $schedule->class_section->course->course_name }} - {{ $schedule->date }} - {{ $schedule->room }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Loại Thay Đổi</label>
                    <select name="change_type" id="change_type" class="w-full p-2 border rounded" required>
                        <option value="nghi">Nghỉ Dạy</option>
                        <option value="day_bu">Dạy Bù</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Lý Do</label>
                    <textarea name="reason" class="w-full p-2 border rounded" required></textarea>
                </div>
                <div id="day_bu_fields" class="hidden">
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Ngày Mới</label>
                        <input type="date" name="new_date" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Bắt Đầu</label>
                        <input type="time" name="new_start_time" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Kết Thúc</label>
                        <input type="time" name="new_end_time" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Phòng Mới</label>
                        <input type="text" name="new_room" class="w-full p-2 border rounded">
                    </div>
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Cập Nhật</button>
            </form>
            <script>
                document.getElementById('change_type').addEventListener('change', function() {
                    document.getElementById('day_bu_fields').classList.toggle('hidden', this.value !== 'day_bu');
                });
            </script>
        </div>
    @endsection
</body>
</html>