<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\sub_category;
use Illuminate\Http\Request;

class Frontend extends Controller
{
    public function index()
    {

        $category =  category::all()->toArray();

        return view('Frontend.index')->with(compact('category'));
    }

    public function category_find($id)
    {
        $sub_category_data = sub_category::where("category" , $id)->get()->toArray();
        $category =  category::where("id" , $id)->get()->toArray();

       return  view("Frontend.category")->with(compact('sub_category_data' , 'category'));
    }

    public function sub_category_data_find($id)
    {
       return  view("Frontend.sub_category_data");
    }
}
