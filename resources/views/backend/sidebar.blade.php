@php
    $role = Auth::user()->role;
@endphp
<!-- Sidebar -->
<div class="sidebar d-none d-md-block bg-dark text-white p-3">
    <h5 class="mb-3"><a class="text-white" href="{{ url('/') }}">Hoàng Thanh</a></h5>
    <ul class="list-unstyled">
        <li><a href="{{ route('dashboard') }}" class="text-white"><i class="fas fa-home me-2"></i> Dashboard</a></li>
        @if($role === 'admin')
            <li><a href="{{ route('users.index')  }}" class="text-white"><i class="fas fa-users me-2"></i> Quản lý
                    người dùng</a></li>
        @endif

    <!-- Quản lý bài viết -->
        @if(in_array($role, ['admin', 'editor']))
            <li>
                <a href="#submenu1" data-bs-toggle="collapse" class="text-white">
                    <i class="fas fa-edit me-2"></i> Quản lý bài viết <i class="fas fa-chevron-down ms-2"></i>
                </a>
                <ul class="collapse list-unstyled ps-3" id="submenu1">
                    <li><a href="{{ route('posts.index') }}" class="text-white"><i class="fas fa-file-alt me-2"></i> Bài
                            viết</a></li>
                    <li><a href="{{ route('categories.index') }}" class="text-white"><i class="fas fa-tags me-2"></i>
                            Danh mục</a></li>
                </ul>
            </li>
        @endif

        <li><a href="{{ route('logout') }}" class="text-white"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-power-off"></i> Đăng xuất </a></li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</div>

<!-- Offcanvas Sidebar (Chỉ hiện trên mobile) -->
<div class="offcanvas offcanvas-start bg-dark text-white" id="mobileSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-unstyled">
            <li><a href="#" class="text-white"><i class="fas fa-home me-2"></i> Dashboard</a></li>
            <li><a href="#" class="text-white"><i class="fas fa-users me-2"></i> Quản lý người dùng</a></li>

            <!-- Quản lý bài viết -->
            <li>
                <a href="#submenu2" data-bs-toggle="collapse" class="text-white">
                    <i class="fas fa-edit me-2"></i> Quản lý bài viết <i class="fas fa-chevron-down ms-2"></i>
                </a>
                <ul class="collapse list-unstyled ps-3" id="submenu2">
                    <li><a href="#" class="text-white"><i class="fas fa-file-alt me-2"></i> Bài viết</a></li>
                    <li><a href="#" class="text-white"><i class="fas fa-tags me-2"></i> Danh mục</a></li>
                </ul>
            </li>

            <li><a href="{{ route('logout') }}" class="text-white"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-power-off"></i> Đăng xuất </a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </ul>
    </div>
</div>
