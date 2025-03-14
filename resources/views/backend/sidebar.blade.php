<aside style="width: 250px; background: #333; color: white; height: 100vh; position: fixed;">
    <h3 style="text-align: center; padding: 10px 0;">Admin Panel</h3>
    <ul style="list-style: none; padding: 0;">
        <li class="menu-item">
            <a href="{{ route('dashboard') }}" style="color: white; text-decoration: none;"><i class="fa-solid fa-gauge"></i>Dashboard</a>
        </li>

        <!-- Quản lý người dùng -->
        <li class="menu-item">
            <a href="{{ route('users.index') }}" style="color: white; text-decoration: none;"><i class="fa-solid fa-users"></i>Quản lý người dùng</a>
        </li>

        <!-- Dropdown Quản lý bài viết -->
        <li class="menu-item">
            <a href="#" class="menu-toggle" data-menu="postDropdown">
                <i class="fa-solid fa-blog"></i>Quản lý bài viết
                <i class="arrow-icon fas fa-chevron-up"></i>
            </a>
            <ul id="postDropdown" class="submenu" style="display: none;">
                <li id="post">
                    <a href="{{ route('posts.index') }}">Bài viết</a>
                </li>
                <li id="categoryPost">
                    <a href="{{ route('categories.index') }}">Danh mục</a>
                </li>
            </ul>
        </li>


        <!-- Đăng xuất -->
        <li class="menu-item">
            <a href="{{ route('logout') }}" style="color: white; text-decoration: none;"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-power-off"></i>Đăng Xuất
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</aside>
