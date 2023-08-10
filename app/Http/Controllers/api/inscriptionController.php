<?php

namespace App\Http\Controllers\api;

use App\Models\inscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class inscriptionController extends Controller
{
    //
    public function index()  {
       $inscriptions= inscription::all();
       if($inscriptions->count()>0)
        return response()->json([
            'status'=>200,
            'inscriptions'=>$inscriptions
           ],200);
       
       else 
        return response()->json([
            'status'=>404,
            'inscriptions'=>' aucun inscriptions'
           ],404);
    
    
      
    }
    public function ajouter(Request $request){
     $validator= Validator::make($request->all(),[
        
        'anneescolaire_id'=>'required',
        'enfant_id'=>'required',



     ]); 
        if ($validator->fails()) {
            return response()->json([
                'status'=>422,
                'ERRORRS'=>$validator->messages() 
               ],422);
        }else {
            $anneescolaire_id = $request->input('anneescolaire_id');
            $enfant_id = $request->input('enfant_id');

            // Create a new instance of the inscription model
            $inscription = new inscription();
    
            // Set the values of the model attributes
            $inscription->anneescolaire_id = $anneescolaire_id;
            $inscription->enfant_id = $enfant_id;
          

            $inscription->updated_at = now();
            $inscription->created_at = now();
    
    
            $inscription->save();
            if($inscription){
                return response()->json([
                    'status'=>200,
                    'message'=>"inscription created secsusflly"
                   ],200);
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>"un problem quelque part"
                   ],500);
            }
        }
    }
    public function getById($id){
     $inscription = inscription::find($id);

     if (!$inscription) {
        return response()->json(
            [ 'status'=>404,
            'message' => 'inscription non trouvé'
        ], 404);
 }

return response()->json($inscription, 200);
}
   
}
