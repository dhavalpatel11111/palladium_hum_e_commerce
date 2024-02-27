<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class adminUserContriller extends Controller
{
    public function index()
    {
        return view('backend.admin.admin_user');
    }

    function Add_user(Request $request)
    {
        $hid = $request['hid'];

        $UserModel = new User();
        if ($hid >= 1) {
            $UserModel = User::find($hid);
        }
        $UserModel->name = $request->name;
        $UserModel->email = $request->email;
        $UserModel->password = $request->password;
        $UserModel->save();

        return "success";
    }


    function user_list()
    {
        $user = User::all();

        $data = [];
        $no = 0;
        foreach ($user as $user) {

            $data[] = [
                'id' => ++$no,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'action' => '<button id="' . $user->id . '" class="btn btn-warning edit">Edit</button> | | <button id="' . $user->id . '" class="btn btn-danger delete">Delete</button>',
            ];
        }
        return response()->json(['data' => $data]);
    }



    function edit_user(Request $request)
    {
        $post = $request->all();
        $editId = $post["id"];
        $categories = User::find($editId);

        return json_encode($categories);
    }


    public function delete_user(Request $request)
    {
        $post = $request->all();
        $id = $post['id'];
        User::find($id)->delete();
    }
}
