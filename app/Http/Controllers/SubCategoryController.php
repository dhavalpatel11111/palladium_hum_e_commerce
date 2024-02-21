<?php

namespace App\Http\Controllers;

use DB;
use App\Models\category;
use App\Models\sub_category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    function index()
    {
        return view('backend.admin.subCategory');
    }
    function save_data(Request $request)
    {

        $category_id = $request['category'];
        $sub_category = $request['subCategory'];
        $hid = $request['hid'];

        $subCategoryModel = new sub_category;
        if ($hid >= 1) {
            $subCategoryModel = sub_category::find($hid);
        }
        $subCategoryModel->category = $category_id;
        $subCategoryModel->sub_category = $sub_category;
        $subCategoryModel->save();

        return view('backend.admin.subCategory');
    }
    function category_data()
    {
        $category_data = category::select('*')->get();

        return $category_data;
    }


    public function sub_category_list()
    {
        $sub_categoryWithCategory = DB::table('sub_category')
            ->join('categories', 'sub_category.category', '=', 'categories.id')
            ->select('sub_category.*', 'categories.category')
            ->get();

        $subCategorydata = [];

        foreach ($sub_categoryWithCategory as $value) {

            $temp['id'] = $value->id;
            $temp['category'] = $value->category;
            $temp['sub_category'] = $value->sub_category;

            $temp['action'] = '<div class="dropdown dropup d-flex justify-content-center">
                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3" style="">
                <a class="dropdown-item edit" data-id="' . $value->id . '" id="teamEdit"><i class="bx bx-edit-alt me-1"></i>Edit</a>
                <a class="dropdown-item delete" data-id="' . $value->id . '" id="teamDelete"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>';

            array_push($subCategorydata, $temp);
        }

        return response()->json(['data' => $subCategorydata]);
    }


    public function edit_sub_category_data(Request $request)
    {

        $post = $request->all();



        if (isset($post['id'])) {

            $response = sub_category::where('id', $post['id'])->get()->first();


        }

        return json_encode($response);
    }


    public function delete_sub_category_data(Request $request)
    {

        $delete = $request->all();

       $delete_sub_category = sub_category::where('id', $delete['id'])->delete();

       if($delete_sub_category){
        echo "Data deleted successfully!";
       }else{
        echo "Issue in query!";
       }
    }

}


