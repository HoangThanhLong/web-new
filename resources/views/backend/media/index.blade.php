@extends('backend.app')
@section('title', 'Danh sách người dùng')

@section('content')
    @include('backend.navbar_top')
    <div class="container">
        <h2>Quản lý Media</h2>

        @if (session('success'))
            <div id="alert-success" class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div id="alert-error" class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf

            <div class="mb-2">
                {{-- Preview ảnh --}}
                <img id="mediaPreviewImage" src="#" alt="Image Preview"
                     style="max-width: 150px; display: none;" class="rounded">

                {{-- Preview video --}}
                <video id="mediaPreviewVideo" controls style="max-width: 300px; display: none;">
                    <source src="#" type="video/mp4">
                    Trình duyệt không hỗ trợ xem video.
                </video>

                {{-- Preview file (pdf, doc, ...) --}}
                <div id="mediaPreviewFile" style="display: none;">
                    <i class="fa-solid fa-file-lines fa-2x text-secondary"></i>
                    <span id="fileName" class="ms-2"></span>
                </div>
            </div>

            <div class="input-group">
                {{-- Nút icon thay input file --}}
                <label for="fileInput" class="btn btn-sm btn-outline-secondary">
                    <i class="fa-solid fa-upload"></i> Ấn vào đây
                </label>
                <input type="file" name="file" class="form-control d-none" id="fileInput"
                       accept=".jpg,.jpeg,.png,.gif,.mp4,.pdf,.doc,.docx"
                       onchange="previewMedia(event)">
                <button type="submit" class="btn btn-sm btn-primary">Xác nhận</button>
            </div>
        </form>


        <div class="row">
            @foreach ($media as $file)
                <div class="col-xl-3 col-md-4 col-6 mb-4">
                    <div class="card">
                        @if(Str::startsWith($file->mime_type, 'image/'))
                            <img src="{{ Storage::url($file->filename) }}" class="card-img-top"
                                 style="height: 200px; object-fit: cover;">
                        @elseif(Str::startsWith($file->mime_type, 'video/'))
                            <video src="{{ Storage::url($file->filename) }}" style="height: 200px" autoplay></video>
                        @else
                            <div class="card-body">
                                <p class="card-text">
                                    <a href="{{ Storage::url($file->filename) }}" target="_blank">
                                        {{ $file->original_name }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        <div class="card-footer display-flex gap-1">
                            <button class="btn btn-sm btn-info w-50">
                                <i class="fa-solid fa-eye d-inline d-md-none"></i> <!-- Icon trên điện thoại -->
                                <span class="d-none d-md-inline">Chi tiết</span> <!-- Chữ trên PC -->
                            </button>
                            <form action="{{ route('media.destroy', $file) }}" method="POST"
                                  class="delete-form-media w-50">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger w-100 delete-btn">
                                    <i class="fas fa-trash-alt d-inline d-md-none"></i>
                                    <span class="d-none d-md-inline">Xoá</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $media->links('pagination::bootstrap-5') }}
    </div>
@endsection
<style>
    .delete-form-media {
        margin-bottom: 0;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('.delete-form');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Ngăn submit mặc định

                Swal.fire({
                    title: 'Bạn có chắc muốn xoá?',
                    text: "Hành động này không thể hoàn tác!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Xoá',
                    cancelButtonText: 'Huỷ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit nếu xác nhận
                    }
                });
            });
        });
    });
</script>


