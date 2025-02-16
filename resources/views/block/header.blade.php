<!-- Header -->
<header class="bg-[#3294c9] shadow-md border-b-2 border-[#1a6a9c]">
    <div class="container mx-auto flex items-center justify-between p-4">
        <!-- Logo và tiêu đề -->
        <div class="flex items-center space-x-4 ">
            <img class="" src="https://sinhvien.fbu.edu.vn/Content/AConfig/images/sv_logo_dashboard.png" alt="Logo Thư Viện">
        </div>
        <div>
            <h2 class="text-4xl font-bold text-white">@yield('title')</h2>
        </div>
        <!-- Nút đăng nhập -->
        <button type="button" onclick="window.location.href='{{ $isLogin ? route('logout') : route('login') }}'"
            class="bg-white text-[#3294c9] px-6 py-2 rounded-lg hover:bg-gray-100 transition duration-300 flex items-center justify-center space-x-2">
            <!-- Icon đăng nhập -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                </path>
            </svg>
            <span>{{ $isLogin ? 'Đăng xuất' : 'Đăng Nhập' }}</span>
        </button>


    </div>
</header>
