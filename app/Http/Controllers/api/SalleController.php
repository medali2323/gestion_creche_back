<?php

namespace App\Http\Controllers\api;

use App\Models\salle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalleController extends Controller
{
    public function index()  {
        $salles= salle::all();
        if($salles->count()>0)
         return response()->json([
             'status'=>200,
             'salles'=>$salles
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'salles'=>' aucun salles'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
        
         'code'=>'required',
         'nb_lit'=>'required|numeric'
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $code = $request->input('code');
             $nb_lit = $request->input('nb_lit');
            
             // Create a new instance of the salle model
             $salle = new salle();
     
             // Set the values of the model attributes
             $salle->code = $code;
             $salle->nb_lit = $nb_lit;
           
 
             $salle->updated_at = now();
             $salle->created_at = now();
     
     
             $salle->save();
             if($salle){
                 return response()->json([
                     'status'=>200,
                     'message'=>"salle created secsusflly"
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
      $salle = salle::find($id);
 
      if (!$salle) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'salle non trouvé'
         ], 404);
  }
 
 return response()->json($salle, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
         
        'code'=>'required',
        'nb_lit'=>'required|numeric'

 
     ]);
 
     // Trouver l'salle à mettre à jour
     $salle = salle::find($id);
 
     // Vérifier si l'salle existe
     if (!$salle) {
         return response()->json(['message' => 'salle non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $salle->code = $code;
     $salle->nb_lit = $nb_lit;
    
     $salle->updated_at = now();
 
     // Sauvegarder les modifications
     $salle->save();
 
     // Retourner la réponse avec l'salle mis à jour
     return response()->json([
         'message' => 'salle mis à jour avec succès', 
         'salle' => $salle
     ]);
 }
 public function delete($id)
 {
  $salle = salle::find($id);
 
  if (!$salle) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'salle non trouvé'
     ], 404);
 }else {
     $salle->delete();
     return response()->json([
     'message' => 'salle supprimé avec succès'],
      200);
 }
 
 }
 }
 