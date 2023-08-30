<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\mode_paiment;

use Illuminate\Http\Request;

class ModePaimentController extends Controller
{
    public function index()  {
        $mode_paiments= mode_paiment::all();
        if($mode_paiments->count()>0)
         return response()->json([
             'status'=>200,
             'mode_paiments'=>$mode_paiments
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'mode_paiments'=>' aucun mode_paiments'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
        
         'mode'=>'required',
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $mode = $request->input('mode');
            
             // Create a new instance of the mode_paiment model
             $mode_paiment = new mode_paiment();
     
             // Set the values of the model attributes
             $mode_paiment->mode = $mode;
           
 
             $mode_paiment->updated_at = now();
             $mode_paiment->created_at = now();
     
     
             $mode_paiment->save();
             if($mode_paiment){
                 return response()->json([
                     'status'=>200,
                     'message'=>"mode_paiment created secsusflly"
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
      $mode_paiment = mode_paiment::find($id);
 
      if (!$mode_paiment) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'mode_paiment non trouvé'
         ], 404);
  }
 
 return response()->json($mode_paiment, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
         
        'mode'=>'required',
        'salle_id'=>'required|numeric'

 
     ]);
 
     // Trouver l'mode_paiment à mettre à jour
     $mode_paiment = mode_paiment::find($id);
 
     // Vérifier si l'mode_paiment existe
     if (!$mode_paiment) {
         return response()->json(['message' => 'mode_paiment non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $mode_paiment->mode = $mode;
    
     $mode_paiment->updated_at = now();
 
     // Sauvegarder les modifications
     $mode_paiment->save();
 
     // Retourner la réponse avec l'mode_paiment mis à jour
     return response()->json([
         'message' => 'mode_paiment mis à jour avec succès', 
         'mode_paiment' => $mode_paiment
     ]);
 }
 public function delete($id)
 {
  $mode_paiment = mode_paiment::find($id);
 
  if (!$mode_paiment) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'mode_paiment non trouvé'
     ], 404);
 }else {
     $mode_paiment->delete();
     return response()->json([
     'message' => 'mode_paiment supprimé avec succès'],
      200);
 }
 
 }
 }
 