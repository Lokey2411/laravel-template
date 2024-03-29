<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "phone" => "required|regex:/(0)[0-9]{9}/",
        ]);
        $oldUser = User::where("email", $request->email)->orWhere("name", $request->name)->first();
        if ($oldUser)
            return redirect(route("home"))->with("error", "Đã tồn tại người dùng");
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect(route("home"))->with("message", "Thêm người dùng thành công");
    }
    public function show($id)
    {
        $user = User::find($id);
        return view("pages.user.information", compact("user"));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "phoneNumber" => "required|regex:/(0)[0-9]{9}/",
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phoneNumber;
        $user->save();
        return redirect(route("home"));
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user)
            redirect(route("home"))->with("message", "Xóa người dùng thành công");
        else
            redirect(route("home"))->with("message", "Xóa người dùng thất bại");
        $user->delete();
        return redirect(route("home"))->with("message", "Xóa người dùng thành công");
    }
}