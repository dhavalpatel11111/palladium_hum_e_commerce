<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function index()
    {
        return view('backend.admin.category');
    }

    function save_data(Request $request)
    {
        $hid = $request['hid'];

        $categoryModel = new category;
        if ($hid >= 1) {
            $categoryModel = category::find($hid);
        }
        $categoryModel->category = $request->category;
        $categoryModel->save();


        return "success";
    }
    function list_data()
    {
        $categories = category::all();
        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->id,
                'category' => $category->category,
                'action' => '<button id="' . $category->id . '" class="btn btn-warning edit">Edit</button> | <button id="' . $category->id . '" class="btn btn-danger delete">Delete</button>',
            ];
        }

        return response()->json(['data' => $data]);
    }
    function edit_data(Request $request)
    {
        $post = $request->all();

        $editId = $post["id"];

        $categories = category::find($editId);

        return json_encode($categories);
    }
    function delete_data(Request $request)
    {
        $post = $request->all();

        $delete = $post['id'];

        category::find($delete)->delete();

        return response()->json(['res' => "data successfully delete into db"]);
    }
}
