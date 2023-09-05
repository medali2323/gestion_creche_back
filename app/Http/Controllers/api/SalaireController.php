<?php

namespace App\Http\Controllers\api;

use App\Models\salaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SalaireController extends Controller
{
    public function index()  {
        $salaire= salaire::all();
        if($salaire->count()>0)
         return response()->json([
             'status'=>200,
             'salaire'=>$salaire
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'salaire'=>' aucun salaire'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
       
        'salaire_brut'=>'required',
        'date_paiement'=>'required|date',
        'employe_id'=>'required'

 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
            
             $salaire_brut = $request->input('salaire_brut');
             $date_paiement = $request->input('date_paiement');
             $employe_id = $request->input('employe_id');

 
             // Create a new instance of the salaire model
             $salaire = new salaire();
     
             // Set the values of the model attributes
             
             $salaire->salaire_brut = $salaire_brut;
             $salaire->date_paiement = $date_paiement;
             $salaire->employe_id = $employe_id;
             $salaire->updated_at = now();
             $salaire->created_at = now();
     
     
             $salaire->save();
             if($salaire){
                 return response()->json([
                     'status'=>200,
                     'message'=>"salaire created secsusflly"
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
      $salaire = salaire::find($id);
 
      if (!$salaire) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'salaire non trouvé'
         ], 404);
  }
 
 return response()->json($salaire, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
      
        'salaire_brut'=>'required',
        'date_paiement'=>'required|date',
        'employe_id'=>'required'
        
     ]);
 
     // Trouver l'salaire à mettre à jour
     $salaire = salaire::find($id);
 
     // Vérifier si l'salaire existe
     if (!$salaire) {
         return response()->json(['message' => 'salaire non trouvé'], 404);
     }
     
     $salaire_brut = $request->input('salaire_brut');
     $date_paiement = $request->input('date_paiement');
     $employe_id = $request->input('employe_id');
     // Mettre à jour les champs avec les nouvelles valeurs
     
     $salaire->salaire_brut = $salaire_brut;
     $salaire->date_paiement = $date_paiement;
     $salaire->employe_id = $employe_id;
     $salaire->updated_at = now();
    

    
 
     // Sauvegarder les modifications
     $salaire->save();
 
     // Retourner la réponse avec l'salaire mis à jour
     return response()->json([
         'message' => 'salaire mis à jour avec succès', 
         'salaire' => $salaire
     ]);
 }
 public function delete($id){
  $salaire = salaire::find($id);
 
  if (!$salaire) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'salaire non trouvé'
     ], 404);
 }
 else {
     $salaire->delete();
     return response()->json([
     'message' => 'salaire supprimé avec succès'],
      200);
 }
 
 }
  
}
