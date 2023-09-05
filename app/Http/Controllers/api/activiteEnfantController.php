<?php

namespace App\Http\Controllers\api;

use App\Models\activite_enfant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class activiteEnfantController extends Controller
{
    public function index()  {
        $activite_enfants= activite_enfant::all();
        if($activite_enfants->count()>0)
         return response()->json([
             'status'=>200,
             'activite_enfants'=>$activite_enfants
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'activite_enfants'=>' aucun activite_enfants'
            ],404);
     
     
       
     }
     public function activiteforenfant($enf)  {
        $activite_enfants= activite_enfants::where('enfant_id',$enf)->get();
    
        if($activite_enfants->count()>0){
             foreach ($activite_enfants as $acf) {
            $activite = activite::find($acf);
            $collection->push($activite);   
            }  
             return response()->json($collection, 200);

        }
     else 
         return response()->json([
             'status'=>404,
             'activite_enfants'=>' aucun activite_enfants'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
         
         'activite_id'=>'required',
         'enfant_id'=>'required',
 
 
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $activite_id = $request->input('activite_id');
             $enfant_id = $request->input('enfant_id');
 
             // Create a new instance of the activite_enfant model
             $activite_enfant = new activite_enfant();
     
             // Set the values of the model attributes
             $activite_enfant->activite_id = $activite_id;
             $activite_enfant->enfant_id = $enfant_id;
           
 
             $activite_enfant->updated_at = now();
             $activite_enfant->created_at = now();
     
     
             $activite_enfant->save();
             if($activite_enfant){
                 return response()->json([
                     'status'=>200,
                     'message'=>"activite_enfant created secsusflly"
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
      $activite_enfant = activite_enfant::find($id);
 
      if (!$activite_enfant) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'activite_enfant non trouvé'
         ], 404);
  }
 
 return response()->json($activite_enfant, 200);
 }
    
 }
     

