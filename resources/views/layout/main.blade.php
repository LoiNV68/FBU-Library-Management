<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titleWeb')</title>
    <link rel="shortcut icon" href="https://sinhvien.fbu.edu.vn/Content/AConfig/images/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">

</head>

<body>
    <main class="bg-gray-100 h-full">
        @if (!isset($layout))
            @include('block.header')
        @endif
        <!-- Main Container -->
        <div class="flex h-[calc(100%-64px)]"> <!-- Trừ chiều cao header -->
            @if (!isset($layout))
                @include('layout.sideBar')
            @endif
            <div
                class="{{ !isset($layout) ? 'flex-1 bg-white shadow-md p-6 overflow-y-auto' : 'flex-1 p-6 overflow-y-hidden' }}">
                @yield('content')
            </div>


        </div>
    </main>
    <!-- Include Chart.js từ CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Include custom.js mà không cần import, vì Chart đã có sẵn trong global scope -->
@yield('scripts')



</body>


</html>
