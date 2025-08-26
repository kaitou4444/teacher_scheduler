<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $lecturers = User::where('role', 'teacher')->get();
        return view('admin.users.index', compact('lecturers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'teacher',
            'full_name' => $request->full_name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.index')->with('success', 'Giảng viên đã thêm!');
    }
}
?>

<!-- Blade template -->
<!DOCTYPE html>
<html>
<head>
    <title>Quản Lý Giảng Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @extends('layouts.app')
    @section('content')
        <div class="container mx-auto p-4">
            <h2 class="text-2xl font-bold mb-4">Quản Lý Giảng Viên</h2>
            @if (session('success'))
                <div class="bg-green-500 text-white p-2 rounded mb-4">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('users.store') }}" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium">Username</label>
                    <input type="text" name="username" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Mật Khẩu</label>
                    <input type="password" name="password" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Họ Tên</label>
                    <input type="text" name="full_name" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" class="w-full p-2 border rounded" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">Thêm Giảng Viên</button>
            </form>
            <table class="w-full border-collapse border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Username</th>
                        <th class="border p-2">Họ Tên</th>
                        <th class="border p-2">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lecturers as $lecturer)
                        <tr>
                            <td class="border p-2">{{ $lecturer->id }}</td>
                            <td class="border p-2">{{ $lecturer->username }}</td>
                            <td class="border p-2">{{ $lecturer->full_name }}</td>
                            <td class="border p-2">{{ $lecturer->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</body>
</html>