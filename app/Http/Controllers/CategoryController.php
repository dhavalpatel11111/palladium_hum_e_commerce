<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
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


        if ($request->hasFile('image')) {

            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;

            $uploadDirectory = 'uploads';

            $uploadPath = public_path($uploadDirectory);

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }

            $request->file('image')->move($uploadPath, $imageName);
        }


        if ($hid >= 1) {
            $categoryModel = category::find($hid);
        }
        $categoryModel->category = $request->category;
        $categoryModel->image = $imageName;
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
                'image' => '<img src="' . asset('uploads/' . $category->image) . '" alt="Not Found!" style="max-height: 50px;">',
                'action' => '<button id="' . $category->id . '" class="btn btn-warning edit">Edit</button> ||  <button id="' . $category->id . '" class="btn btn-danger delete">Delete</button>',
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
