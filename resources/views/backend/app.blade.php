@include('backend.header')

@include('backend.sidebar') <!-- Thêm sidebar -->
<main class="main_content"> <!-- Nội dung chính -->
    @yield('content')
</main>

@include('backend.footer')
