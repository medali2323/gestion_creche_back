<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\Forgetpasswordrequest;
use App\Notifications\resetpasswordnotification;

class forgetpasswordcontroller extends Controller
{
    //

public function forgotPassword(Forgetpasswordrequest $request){
    $input = $request->only('email');
    $user=User::where('email',$input)->first();
    $user->notify(new resetpasswordnotification());
    $success['success'] = true;
    return response()->json($success, 200);
}
}
