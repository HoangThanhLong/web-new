<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('backend.users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.view', compact('user'));
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
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Tên không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã tồn tại.',
            'avatar.image' => 'File phải là hình ảnh.',
            'avatar.mimes' => 'Ảnh phải có định dạng jpeg, png, jpg hoặc gif.',
            'avatar.max' => 'Ảnh không được vượt quá 2MB.',
        ]);

        // Cập nhật user
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        // Xử lý ảnh đại diện nếu có upload
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = $user->id . '.' . $extension;

            // Xoá avatar cũ nếu có
            if ($user->avatar && Storage::exists('public/avatars/' . basename($user->avatar))) {
                Storage::delete('public/avatars/' . basename($user->avatar));
            }

            // Lưu file mới
            $file->storeAs('public/avatars', $filename);
            $user->avatar = 'avatars/' . $filename; // lưu path tương đối (không cần 'storage/' ở đây)
        }

        $user->save();
        return redirect()->route('users.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Xoá avatar nếu có
        if ($user->avatar && Storage::exists('public/' . $user->avatar)) {
            Storage::delete('public/' . $user->avatar);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Xoá người dùng thành công!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
    }
}
