<?php

namespace App\Http\Controllers\api;

use Otp;
use Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\resetingpasswordrequest;

class resetingpasswordcontroller extends Controller
{
    private $otp;
    public function __construct(){
        $this->otp = new Otp;

    }
    public function passwordReset(resetingpasswordrequest $request){ 
        $otp2 = $this->otp->validate($request->email, $request->otp);
        if(! $otp2->status){
            return response()->json(['error' => $otp2], 401); 
        }
        
        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);
        $user->tokens()->delete();
        $success['success'] = true;
        return response()->json($success, 200);
    }
   

}




