
@include('backend.header')

@include('backend.sidebar') <!-- Thêm sidebar -->
<main>
    @yield('content')
</main>

@include('backend.footer')
