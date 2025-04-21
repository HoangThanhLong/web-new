<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Media::query();

        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        $media = $query->latest()->paginate(10);

        return view('backend.media.index', compact('media'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('file')) {
            return back()->withErrors(['file' => 'Không được để trống.']);
        }
        $request->validate([
            'file' => [
                'required',
                'file',
                function ($attribute, $value, $fail) {
                    $mime = $value->getMimeType();
                    $size = $value->getSize(); // in bytes

                    if (str_starts_with($mime, 'image/') || in_array($mime, ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])) {
                        if ($size > 2 * 1024 * 1024) {
                            $fail('Ảnh và tài liệu không được vượt quá 2MB.');
                        }
                    } elseif (str_starts_with($mime, 'video/')) {
                        if ($size > 50 * 1024 * 1024) {
                            $fail('Video không được vượt quá 50MB.');
                        }
                    } else {
                        $fail('Định dạng file không được hỗ trợ.');
                    }
                },
            ],
        ]);

        $file = $request->file('file');
        $path = $file->store('public/media');

        Media::create([
            'filename' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Tải lên thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Media $media)
    {
        if (auth()->user()->cannot('delete', $media)) {
            abort(403);
        }

        Storage::delete($media->filename);
        $media->delete();

        return back()->with('success', 'Đã xoá!');
    }
}
