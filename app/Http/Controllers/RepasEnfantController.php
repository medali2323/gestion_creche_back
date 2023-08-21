<?php

namespace App\Http\Controllers;

use App\Models\enfant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RepasEnfantController extends Controller
{
    public function index()  {
        $repas_enfant= repas_enfant::all();
        if($repas_enfant->count()>0)
         return response()->json([
             'status'=>200,
             'repas_enfant'=>$repas_enfant
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'repas_enfant'=>' aucun repas_enfant'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
      
        'repas_id' => 'required',
        'inscription_id' => 'required'
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
            
             $repas_id = $request->input('repas_id');
             $inscription_id = $request->input('inscription_id');

 
             // Create a new instance of the repas_enfant model
             $repas_enfant = new repas_enfant();
     
             // Set the values of the model attributes
             
             $repas_enfant->repas_id = $repas_id;
             $repas_enfant->inscription_id = $inscription_id;

             $repas_enfant->updated_at = now();
             $repas_enfant->created_at = now();
     
     
             $repas_enfant->save();
             if($repas_enfant){
                 return response()->json([
                     'status'=>200,
                     'message'=>"repas_enfant created secsusflly"
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
      $repas_enfant = repas_enfant::find($id);
 
      if (!$repas_enfant) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'repas_enfant non trouvé'
         ], 404);
  }
 
 return response()->json($repas_enfant, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
       
        $repas_id = $request->input('repas_id'),
        $inscription_id = $request->input('inscription_id')
        
     ]);
 
     // Trouver l'repas_enfant à mettre à jour
     $repas_enfant = repas_enfant::find($id);
 
     // Vérifier si l'repas_enfant existe
     if (!$repas_enfant) {
         return response()->json(['message' => 'repas_enfant non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
  
     $repas_enfant->repas_id = $request->input('repas_id');
     $repas_enfant->inscription_id = $request->input('inscription_id');
    
 
     // Sauvegarder les modifications
     $repas_enfant->save();
 
     // Retourner la réponse avec l'repas_enfant mis à jour
     return response()->json([
         'message' => 'repas_enfant mis à jour avec succès', 
         'repas_enfant' => $repas_enfant
     ]);
 }
 public function delete($id){
  $repas_enfant = repas_enfant::find($id);
 
  if (!$repas_enfant) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'repas_enfant non trouvé'
     ], 404);
 }
 else {
     $repas_enfant->delete();
     return response()->json([
     'message' => 'repas_enfant supprimé avec succès'],
      200);
 }
 
 }
 public function repasforenfant($idenf)  {
    $repas_enfants= repas_enfant::where('enfant',$idenf)->get();
    if($repas_enfants->count()>0)
     return response()->json([
         'status'=>200,
         'repas_enfants'=>$repas_enfants
        ],200);
    
    else 
     return response()->json([
         'status'=>404,
         'repas_enfants'=>' aucun repas_enfants for enfant'
        ],404);
 }
}


