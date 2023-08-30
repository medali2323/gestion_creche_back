<?php

namespace App\Http\Controllers\api;

use App\Models\tva;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TvaController extends Controller
{
    public function index()  {
        $factures= tva::all();
        if($tvas->count()>0)
         return response()->json([
             'status'=>200,
             'tvas'=>$tvas
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'tvas'=>' aucun tvas'
            ],404);
     
     
       
     }
    
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
         'code'=>'required|string|max:50',
         'taux_tva' => 'required|numiric',
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $code = $request->input('code');
             $taux_tva = $request->input('taux_tva');
          
            
          
             // Create a new instance of the tva model
             $tva = new tva();
     
             // Set the values of the model attributes
             $tva->code = $code;
             $tva->taux_tva = $taux_tva;
            
 
             $tva->updated_at = now();
             $tva->created_at = now();
     
     
             $tva->save();
             if($tva){
                 return response()->json([
                     'status'=>200,
                     'message'=>"tva created secsusflly"
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
      $tva = tva::find($id);
 
      if (!$tva) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'tva non trouvé'
         ], 404);
  }
 
 return response()->json($tva, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        'code'=>'required|string|max:50',
        'taux_tva' => 'required|numiric',
    
 
     ]);
 
     // Trouver l'tva à mettre à jour
     $tva = tva::find($id);
 
     // Vérifier si l'tva existe
     if (!$tva) {
         return response()->json(['message' => 'tva non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $tva->code = $code;
     $tva->taux_tva = $taux_tva;
     
     $tva->updated_at = now();
 
     // Sauvegarder les modifications
     $tva->save();
 
     // Retourner la réponse avec l'tva mis à jour
     return response()->json([
         'message' => 'tva mis à jour avec succès', 
         'tva' => $tva
     ]);
 }
 public function delete($id)
 {
  $tva = tva::find($id);
 
  if (!$tva) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'tva non trouvé'
     ], 404);
 }else {
     $tva->delete();
     return response()->json([
     'message' => 'tva supprimé avec succès'],
      200);
 }
 
 }
 }
 
