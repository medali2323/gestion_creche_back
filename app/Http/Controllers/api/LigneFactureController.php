<?php

namespace App\Http\Controllers\api;

use App\Models\facture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LigneFactureController extends Controller
{
    public function index()  {
        $factures= ligne_facture::all();
        if($ligne_factures->count()>0)
         return response()->json([
             'status'=>200,
             'ligne_factures'=>$ligne_factures
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'ligne_factures'=>' aucun ligne_factures'
            ],404);
     
     
       
     }
     public function getlignesforfacture($idf)  {
        $factures= ligne_facture::where('facture_id',$idf)->get();
        if($ligne_factures->count()>0)
         return response()->json([
             'status'=>200,
             'ligne_factures'=>$ligne_factures
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'ligne_factures'=>' aucun ligne_factures'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
         'code'=>'required|string|max:50',
         'inscription_id' => 'required',
         'facture_id' => 'required'
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $code = $request->input('code');
             $inscription_id = $request->input('inscription_id');
             $facture_id = $request->input('facture_id');
            
          
             // Create a new instance of the ligne_facture model
             $ligne_facture = new ligne_facture();
     
             // Set the values of the model attributes
             $ligne_facture->code = $code;
             $ligne_facture->inscription_id = $inscription_id;
             $ligne_facture->facture_id = $facture_id;
            
 
             $ligne_facture->updated_at = now();
             $ligne_facture->created_at = now();
     
     
             $ligne_facture->save();
             if($ligne_facture){
                 return response()->json([
                     'status'=>200,
                     'message'=>"ligne_facture created secsusflly"
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
      $ligne_facture = ligne_facture::find($id);
 
      if (!$ligne_facture) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'ligne_facture non trouvé'
         ], 404);
  }
 
 return response()->json($ligne_facture, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        'code'=>'required|string|max:50',
        'inscription_id' => 'required',
        'facture_id' => 'required',
    
 
     ]);
 
     // Trouver l'ligne_facture à mettre à jour
     $ligne_facture = ligne_facture::find($id);
 
     // Vérifier si l'ligne_facture existe
     if (!$ligne_facture) {
         return response()->json(['message' => 'ligne_facture non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $ligne_facture->code = $code;
     $ligne_facture->inscription_id = $inscription_id;
     $ligne_facture->facture_id = $facture_id;
     
     $ligne_facture->updated_at = now();
 
     // Sauvegarder les modifications
     $ligne_facture->save();
 
     // Retourner la réponse avec l'ligne_facture mis à jour
     return response()->json([
         'message' => 'ligne_facture mis à jour avec succès', 
         'ligne_facture' => $ligne_facture
     ]);
 }
 public function delete($id)
 {
  $ligne_facture = ligne_facture::find($id);
 
  if (!$ligne_facture) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'ligne_facture non trouvé'
     ], 404);
 }else {
     $ligne_facture->delete();
     return response()->json([
     'message' => 'ligne_facture supprimé avec succès'],
      200);
 }
 
 }
 }
 
