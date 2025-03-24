@extends('backend.app')

@section('title', 'Danh sách người dùng')

@section('content')
    @include('backend.navbar_top')
    <div class="container">
        <h1>Danh sách người dùng</h1>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tên</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Hành động</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div id="selected_role">
                            <select class="form-control" name="user[role]" {{ Auth::user()->id == $user->id ? 'disabled' : '' }} >
                                @foreach(\App\Models\User::getRole() as $key => $item)
                                    <option value="{{ $key }}" {{ $key === $user->role ? 'selected' : '' }} >
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td>
                        <!-- Button Chi tiết -->
                        <a class="btn btn-info btn-sm" href="{{ route('users.view', $user->id) }}">
                            <i class="fas fa-eye d-inline d-md-none"></i> <!-- Hiển thị icon trên điện thoại -->
                            <span class="d-none d-md-inline">Chi tiết</span> <!-- Hiển thị chữ trên PC -->
                        </a>

                        <!-- Button Sửa -->
                        <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
                            <i class="fas fa-edit d-inline d-md-none"></i> <!-- Icon trên điện thoại -->
                            <span class="d-none d-md-inline">Sửa</span> <!-- Chữ trên PC -->
                        </a>

                        <!-- Button Xoá -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;"
                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">
                                <i class="fas fa-trash-alt d-inline d-md-none"></i> <!-- Icon trên điện thoại -->
                                <span class="d-none d-md-inline">Xoá</span> <!-- Chữ trên PC -->
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection
