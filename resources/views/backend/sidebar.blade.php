@php
    $role = Auth::user()->role;
@endphp

<!-- Sidebar cho màn hình lớn -->
<nav class="sidebar d-none d-md-block bg-dark text-white vh-100 p-3">
    <a href="{{ url('/') }}" class="navbar-brand text-white fs-4 fw-bold d-block mb-4" style="text-align: center; padding-top: 10px">VSEA</a>
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a class="nav-link text-white" href="{{ route('dashboard') }}">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
        </li>

        @if($role === 'admin')
            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="{{ route('users.index') }}">
                    <i class="fas fa-users me-2"></i> Quản lý người dùng
                </a>
            </li>
        @endif

        @if(in_array($role, ['admin', 'editor']))
            <li class="nav-item mb-2">
                <a class="nav-link text-white collapsed" data-bs-toggle="collapse" href="#postMenu" role="button" aria-expanded="false" aria-controls="postMenu">
                    <i class="fas fa-edit me-2"></i> Quản lý bài viết <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="collapse" id="postMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('posts.index') }}">
                                <i class="fas fa-file-alt me-2"></i> Bài viết
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('categories.index') }}">
                                <i class="fas fa-tags me-2"></i> Danh mục
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif

        <li class="nav-item mb-2">
            <a class="nav-link text-white" href="{{ route('media.index') }}">
                <i class="fa-solid fa-photo-film me-2"></i> Quản lý media
            </a>
        </li>

        <li class="nav-item mt-3">
            <a class="nav-link text-white" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-power-off me-2"></i> Đăng xuất
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>

<!-- Offcanvas cho mobile -->
<div class="offcanvas offcanvas-start bg-dark text-white" id="mobileSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('dashboard') }}">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>
            @if($role === 'admin')
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('users.index') }}">
                        <i class="fas fa-users me-2"></i> Quản lý người dùng
                    </a>
                </li>
            @endif
            @if(in_array($role, ['admin', 'editor']))
                <li class="nav-item">
                    <a class="nav-link text-white collapsed" data-bs-toggle="collapse" href="#postMenuMobile" role="button" aria-expanded="false">
                        <i class="fas fa-edit me-2"></i> Quản lý bài viết <i class="fas fa-chevron-down float-end"></i>
                    </a>
                    <div class="collapse" id="postMenuMobile">
                        <ul class="nav flex-column ms-3">
                            <li><a class="nav-link text-white" href="{{ route('posts.index') }}"><i class="fas fa-file-alt me-2"></i> Bài viết</a></li>
                            <li><a class="nav-link text-white" href="{{ route('categories.index') }}"><i class="fas fa-tags me-2"></i> Danh mục</a></li>
                        </ul>
                    </div>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('media.index') }}">
                    <i class="fa-solid fa-photo-film me-2"></i> Quản lý media
                </a>
            </li>
            <li class="nav-item mt-3">
                <a class="nav-link text-white" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-power-off me-2"></i> Đăng xuất
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
