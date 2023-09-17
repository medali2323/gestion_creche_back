<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use File;
class UserController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'role'=>'required',
                'idr'=>'required'

            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'idr' => $request->idr,

            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'role'=>$user->role,
                'idr'=>$user->idr

            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function logout(Request $request)  {
        auth()->user()->tokens()->delete();
        return ['message'=> 'logout'];
    }
    public function index()  {
        $users= user::all();
        if($users->count()>0)
         return response()->json([
             'status'=>200,
             'users'=>$users
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'users'=>' aucun users'
            ],404);
}
public function change_password(Request $request){
    $validator = Validator::make($request->all(), [
        'old_password'=>'required',
        'password'=>'required',
        'confirm_password'=>'required|same:password'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'message'=>'Validations fails',
            'errors'=>$validator->errors()
        ],422);
    }

    $user=$request->user();
    if(Hash::check($request->old_password,$user->password)){
        $user->update([
            'password'=>Hash::make($request->password)
        ]);
        return response()->json([
            'message'=>'Password successfully updated',
        ],200);
    }else{
        return response()->json([
            'message'=>'Old password does not matched',
        ],400);
    }

}


}