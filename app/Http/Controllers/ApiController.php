<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api_model;
use App\Models\UserModel;
use Validator;
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
        $rules = array([
            "name" => "required",
            "email" => "required",
            "phone" => "required | min:11"
        ]);
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
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
        else{
            return response()->json([
                "status" => 401,
                "message" => "You are doing wrong thing"
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
    public function search($email){
        $user_email = Api_model::where('email','like','%'.$email.'%')
        ->get();

        if(sizeof($user_email) == 0)
        {
            return "There are no data Found";
        }

        else
        {
            return $user_email;
        }

    }

    public function profile(){
        return response()->json([
            "status" => 1,
            "message" => "Success",
            "data" => auth()->user()
        ]);
    }
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => 1,
            "message" => "Logout"
        ]);
    }

}
