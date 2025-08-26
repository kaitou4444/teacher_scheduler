<!DOCTYPE html>
<html>
<head>
    <title>Đăng Nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Đăng Nhập Quản Trị Viên</h2>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" class="w-full p-2 border rounded" required>
                @error('username')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Mật Khẩu</label>
                <input type="password" name="password" id="password" class="w-full p-2 border rounded" required>
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <button type="submit"  class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Đăng Nhập</button>
        </form>
    </div>
</body>
</html>