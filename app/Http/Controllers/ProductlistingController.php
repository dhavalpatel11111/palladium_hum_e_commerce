<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\imagetables;
use App\Models\productlisting;
use App\Models\sub_category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductlistingController extends Controller
{
    function index()
    {
        return view('backend.admin.productlisting');
    }
    function productImg(Request $request)
    {

        $hiddenId = $request->id;


        if (!$hiddenId) {

            $temp = "tempFolder";

            $tempFolder = time() . '.' . $temp;

            $uploadPath = public_path('upload/' . $tempFolder);


            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0777, true, true);
            }

            $img = $request->file('file');

            $allimg = [];

            foreach ($img as $key => $singleImg) {

                $imageName = $singleImg->getClientOriginalName();

                $singleImg->move($uploadPath, $imageName);

                array_push($allimg, $imageName);

                $temparr = ["allimg" => $allimg, "tempFolder" => $tempFolder];
            }



        } else {
            $uploadPath = public_path('upload/' . $hiddenId);

            $img = $request->file('file');

            $allimg = [];

            foreach ($img as $key => $singleImg) {

                $imageName = $singleImg->getClientOriginalName();


                $singleImg->move($uploadPath, $imageName);
                array_push($allimg, $imageName);

                $temparr = ["allimg" => $allimg, "tempFolder" => $hiddenId];
            }


        }
        return $temparr;
    }

    function productlisting_save(Request $request)
    {

        $response['status'] = 0;
        $post_data = $request->all();

        // category
        if ($post_data['hid'] && $request['category'] == "") {
            $categoryObj = productlisting::select('category')
                ->where('id', $post_data['hid'])
                ->get()->toArray();

            $category = $categoryObj[0]['category'];
        } elseif ($post_data['hid'] && !empty($request['category'])) {
            $category = $request['category'];
        } else {
            $category = $request['category'];
        }


        // subcategory
        if ($post_data['hid'] && $request['subCategory'] == "") {
            $subCategoryobj = productlisting::select('sub_category')
                ->where('id', $post_data['hid'])
                ->get();

            $subCategory = $subCategoryobj[0]['sub_category'];
        } elseif ($post_data['hid'] && !empty($request['subCategory'])) {
            $subCategory = $request['subCategory'];
        } else {
            $subCategory = $request['subCategory'];
        }


        // Table edit and insert call

        if ($post_data['hid'] > 0) {
            DB::table('productlistings')
                ->where('id', $post_data['hid'])
                ->update([
                    'product_name' => $post_data['productName'],
                    'description' => $post_data['description'],
                    'product_brief' => $post_data['product_brief'],
                    'price' => $post_data['price'],
                    'discount_price' => $post_data['discount_price'],
                    'category' => $category,
                    'sub_category' => $subCategory,
                    'quantity' => $post_data['quantity']
                ]);

            //delete before insert new one


            if ($post_data['allimg'] != '') {
                $imgArray = explode(',', $post_data['allimg']);
                imagetables::where("mainId", $post_data['hid'])->delete();
                foreach ($imgArray as $key => $singleImage) {
                    imagetables::create([
                        'mainId' => $post_data['hid'],
                        'image' => $singleImage
                    ]);
                }
            } else {
                imagetables::where("mainId", $post_data['hid'])->delete();

            }


        } else {
            productlisting::create([
                'product_name' => $post_data['productName'],
                'description' => $post_data['description'],
                'product_brief' => $post_data['product_brief'],
                'price' => $post_data['price'],
                'discount_price' => $post_data['discount_price'],
                'category' => $category,
                'sub_category' => $subCategory,
                'quantity' => $post_data['quantity']
            ]);

            $lastId = DB::getPdo()->lastInsertId();
            if ($lastId > 0) {
                $folder = $post_data['folder'];
                $imgArray = explode(',', $post_data['allimg']);
                $uploadPath = public_path('upload/' . $folder);
                $newfolderPath = public_path('upload/' . $lastId);
                if (File::exists($uploadPath)) {
                    rename($uploadPath, $newfolderPath);
                    foreach ($imgArray as $key => $singleImage) {

                        imagetables::create([
                            'mainId' => $lastId,
                            'image' => $singleImage
                        ]);
                    }
                }
                $response['status'] = 1;
                $response['message'] = "data insert";
            } else {
                $response['message'] = "somthing gone wrong";
            }
        }
        return json_encode($response);
    }

    function subCategory(Request $request)
    {

        $categoryid = $request->all()['categoryid'];
        $subCategory_data = sub_category::where("category", $categoryid)->get()->toArray();


        return $subCategory_data;
    }

    function productlisting_listing()
    {
        $productlistingData = productlisting::all();


        $tbody = [];

        foreach ($productlistingData as $value) {

            // category

            $categoryFromProduct = $value['category'];

            $category = category::find($categoryFromProduct);

            $categories_name = $category['category'];

            // sub_category

            $subcategoryFromProduct = $value['sub_category'];

            $sub_category = sub_category::find($subcategoryFromProduct)->toArray();

            $sub_category_name = $sub_category['sub_category'];


            // listing

            $tbody[] = [
                'id' => $value['id'],
                'product_name' => $value['product_name'],
                'description' => $value['description'],
                'product_brief' => $value['product_brief'],
                'price' => $value['price'],
                'discount_price' => $value['discount_price'],
                'category' => $categories_name,
                'sub_category' => $sub_category_name,
                'quantity' => $value['quantity'],
                'action' => '<button id="' . $value['id'] . '" class="btn btn-warning edit">Edit</button> | <button id="' . $value['id'] . '" class="btn btn-danger delete">Delete</button>',
            ];

        }


        $output = ['data' => $tbody];


        return json_encode($output);
    }


    function productlisting_edit(Request $request)
    {
        $editId = $request['editId'];

        $productlisting = productlisting::select('*')->where('id', $editId)->get();


        $singleproductListingData = $productlisting[0];


        $imageTableData = imagetables::select('*')->where('mainId', $editId)->get();

        $imgArray = [];

        $dropzoneWithData = '';


        foreach ($imageTableData as $key => $value) {
            $dropzoneWithData .= "<div class='image'>";
            $dropzoneWithData .= "<img src='" . asset("upload/" . $editId . "/" . $value['image']) . "' alt='dropzone image' height='100px' weight='auto'>
                 <button class='btn btn-danger delete_img' data-id='" . $value['mainId'] . "' data-image='" . $value['image'] . "' type='button'>Delete</button> ";
            $dropzoneWithData .= "</div>";

            array_push($imgArray, $value['image']);
        }



        return response()->json(['singleproductListingData' => $singleproductListingData, 'dropzoneWithData' => $dropzoneWithData, 'imgArray' => $imgArray]);
    }

    function dropzoneDelete(Request $request)
    {

        $deleteDropzoneId = $request->deleteDropzoneImageId;

        $deleteDropzoneImageName = $request->deleteDropzoneImageName;


        $uploadPath = public_path('upload' . '/' . $deleteDropzoneId);



        if (File::exists($uploadPath)) {
            File::delete($uploadPath . '/' . $deleteDropzoneImageName);



            // Deleting an directory if empty

            // Set the current working directory
            $directory = $uploadPath;

            // Returns array of files
            $files1 = scandir($directory);

            // Count number of files and store them to variable
            $num_files = count($files1) - 2;

            // removing an folder
            if ($num_files < 1) {
                File::deleteDirectory($uploadPath);
            }
        }


        // deleting an image from DB of imagetable
        $imageDel = imagetables::where("image", $deleteDropzoneImageName)->where("mainId", $deleteDropzoneId)->delete();

        if ($imageDel) {
            echo '<pre>';
            print_r("deleted");
            die;
        } else {
            echo '<pre>';
            print_r("deleted");
            die;
        }
    }
    function delete_data(Request $request)
    {

        $deleteId = $request->deleteId;

        // productlisting table delete
        $user = productlisting::find($deleteId);

        $user->delete();

        // imagetable table delete
        $imagetables = imagetables::where("mainId", $deleteId);

        $imagetables->delete();



        $uploadPath = public_path('upload' . '/' . $deleteId);


        if (File::exists($uploadPath)) {
            if (File::deleteDirectory($uploadPath)) {
                echo '<pre>';
                print_r("The folder has been deleted");
                die;
            } else {
                echo '<pre>';
                print_r("Issue in the code!");
                die;
            }
        }
    }



    function removeButtonDZ(Request $request)
    {
        $post = $request->all();
        
        $targeted_file = $post['target_file'];


    }
}