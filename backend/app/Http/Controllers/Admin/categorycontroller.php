<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class categorycontroller extends Controller
{
    public function index (Request $request){
        $category=category::all();
        

        return response()->json([
            "status" => 200,
            "category" =>  $category ,
        ]
        );


    }
    public function stor (Request $request){
        $category = new category();
        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        return response()->json([
            "status" => 201,
            "category" =>  $category
        ]);
    }
    public function update($id ,Request $request){
        $category=category::find($id);

        if(!$category){
            return response()->json([
                "status" => 404,
            "message" =>  "category not found"
            ]);
        }
        $category->name=$request->name;
        $category->status=$request->status;
        $category->save();
        return response()->json([
            "status" => 200,
            "category" =>  $category
        ]);
    }
    public function delete($id ,Request $request){
        $category=category::find($id);

        if(!$category){
            return response()->json([
                "status" => 404,
            "message" =>  "categories not found"
            ]);
        }
        $category->delete();

        return response()->json([
            "status" => 200,
            "message" =>  "Delete success"
        ]);
    }
    public function show($id ,Request $request){
        $category=category::with("product")->find($id);


        if(!$category){
            return response()->json([
                "status" => 404,
            "message" =>  "categories not found"
            ]);
        }
       
        return response()->json([
            "status" => 200,
            "category" =>  $category
        ]);
    }
}
