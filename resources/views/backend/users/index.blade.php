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
                        <a class="btn btn-info btn-sm" href="{{ route('users.view', $user->id) }}">Chi tiết</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">Sửa</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa không?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection
