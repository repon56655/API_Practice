<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api_model;
use App\Models\UserModel;
class ApiController extends Controller
{
    // public function index($name){
    //     $user = $name?Api_model::table('api_models')->where('name', $name)->first():Api_model::all();
    //     return $user;
    // }
    public function show(){

        $user= Api_model::all();
        return $user;
    }
    public function store(Request $request){


        $user= new Api_model;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $save = $user->save();

        if($save){
            return response()->json([
                'status' => 1,
                'message' => "Success",
    
            ]);
        }
        else{
            return response()->json([
                'status' => 0,
                'message' => "Failed",
    
            ]);
        }
    }
    public function update(Request $request, $id){

        $user = Api_model::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $update = $user->save();
        if($update){
            return response()->json([
                "status" => 101,
                "message" => "Successfully Done"
            ]);

        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "Failed to update"
            ]);
        }

    }
    public function delete(Request $request, $id){

        $user = Api_model::find($id);
        $delete = $user->delete();
        if($delete){
            return response()->json([
                "status" => 101,
                "message" => "Delete Successfully"
            ]);

        }
        else{
            return response()->json([
                "status" => 404,
                "message" => "Failed to Delete"
            ]);
        }

    }

}
