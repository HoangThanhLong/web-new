@extends('backend.app')

@section('title', 'Chỉnh sửa người dùng')

@section('content')
    @include('backend.navbar_top')
    <div class="container">
        <h1>Sửa người dùng</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="avatar" class="form-label">Ảnh đại diện</label>

                <div class="mb-2">
                    {{-- Ảnh cũ hoặc preview ảnh mới --}}
                    <img id="avatarPreview"
                         src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://via.placeholder.com/120x120?text=No+Avatar' }}"
                         alt="Preview"
                         width="120"
                         class="rounded">
                </div>

                <input type="file" class="form-control" name="avatar" id="avatar" onchange="previewAvatar(event)">
            </div>
            <div class="mb-3">
                <label class="form-label">Tên:</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $user->email) }}">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Huỷ</a>
        </form>
    </div>
@endsection
