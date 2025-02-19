@extends('layout.main')
@section('content')
    <div class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

        <!-- Tăng kích thước form và thêm padding -->
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg"> <!-- Thay max-w-md bằng max-w-lg -->
            @if (session('msg'))
                <div class="p-4 mb-4 text-sm rounded-lg border 
                {{ $isLogin ? 'text-red-700 bg-red-100 border-red-400' : 'text-green-700 bg-green-100 border-green-400' }}"
                    role="alert">
                    {{ session('msg') }}
                </div>
            @endif


            <h2 class="text-3xl font-bold text-primary text-center mb-8">Đăng Nhập</h2> <!-- Tăng kích thước tiêu đề -->
            <form action="{{ route('handle-login') }}" method="POST">
                @csrf
                <div class="mb-6"> <!-- Tăng khoảng cách giữa các input -->
                    <label for="username" class="block text-gray-700 mb-3 text-lg">Tên đăng nhập</label>
                    <!-- Tăng kích thước label -->
                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary text-lg"
                        placeholder="Nhập tên đăng nhập" />

                    @error('username')
                        <div style="color: #DB3030; font-size: 12.25px; margin-top: 4px; width: 100%;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-8"> <!-- Tăng khoảng cách giữa các input -->
                    <label for="password" class="block text-gray-700 mb-3 text-lg">Mật khẩu</label>
                    <!-- Tăng kích thước label -->
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary text-lg"
                        placeholder="Nhập mật khẩu" />
                    @error('password')
                        <div style="color: #DB3030; font-size: 12.25px; margin-top: 4px; width: 100%;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full bg-primary text-white py-3 px-6 rounded-lg hover:bg-primary-dark transition duration-300 text-lg">
                    <!-- Tăng kích thước nút -->
                    Đăng Nhập
                </button>
            </form>
        </div>
    </div>
@endsection
