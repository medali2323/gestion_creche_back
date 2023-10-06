<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use File;
use App\Notifications\emailverificationnotification;
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
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                $user->notify(new emailverificationnotification())
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
                'idr'=>$user->idr,
                'user'=>$user

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
    public function isFirstLogin($userId)
    {
        $user = User::find($userId);

        if ($user) {
            return $user->is_first_login;
        }

        return false; // Si l'utilisateur n'est pas trouvé, renvoyez false par défaut.
    }

    public function update(Request $request, $id)
{
    // Validez les données de la requête
    
  

    // Récupérez l'utilisateur à mettre à jour
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    }

    // Mettez à jour les champs de l'utilisateur
    $user->first_login = $request->input('first_login');
    // Ajoutez d'autres champs à mettre à jour si nécessaire

    // Enregistrez les modifications
    $user->save();

    return response()->json(['message' => 'Utilisateur mis à jour avec succès', 'user' => $user]);
}

public function update_profile(Request $request,$id){
    $validator = Validator::make($request->all(), [
        'image_users'=>'nullable|image|mimes:jpg,bmp,png'
    ]);
    if ($validator->fails()) {
        return response()->json([
            'message'=>'Validations fails',
            'errors'=>$validator->errors()
        ],422);
    } 
    $user = User::findOrFail($id);

    if (!$user) {
        return response()->json(['user' => 'User not found']);
    }


    if($request->hasFile('image_users')){
        if($user->image_users){
            $old_path=public_path().'/uploads/profile_images/'.$user->image_users;
            if(File::exists($old_path)){
                File::delete($old_path);
            }
        }

        $image_name='profile-image-'.time().'.'.$request->image_users->extension();
        $request->image_users->move(public_path('/uploads/profile_images'),$image_name);
    }else{
        $image_name=$user->image_users;
    }


    $user->update([
        'image_users'=>$image_name
    ]);

    return response()->json([
        'message'=>'Profile successfully updated',
    ],200);
}

public function getById($id){
    $user = User::find($id);

    if (!$user) {
       return response()->json(
           [ 'status'=>404,
           'message' => 'user non trouvé'
       ], 404);
}
return response()->json($user, 200);
}
}
