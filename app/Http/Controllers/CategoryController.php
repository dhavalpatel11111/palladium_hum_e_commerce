<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\sub_category;
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
        $no = 0;
        foreach ($categories as $category) {
            $data[] = [
                'id' => ++$no,
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
        $id = $post['id'];

        $sub_category_data = sub_category::where("category", $id)->get()->toArray();

        if (empty($sub_category_data)) {
            category::find($id)->delete();

            return response()->json(['res' => "data successfully delete into db"]);
        } else {
            return response()->json(['res' => "This Category is Used in Sub-category So you should delete that First !"]);
        }
    }
}
