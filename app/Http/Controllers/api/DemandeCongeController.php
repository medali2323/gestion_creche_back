<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\demande_conge;

class DemandeCongeController extends Controller
{
    public function index()  {
        $demande_conges= demande_conge::all();
        if($demande_conges->count()>0)
         return response()->json([
             'status'=>200,
             'demande_conges'=>$demande_conges
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'demande_conges'=>' aucun demande_conges'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
         'code'=>'required|string|max:50',
         'date_deb'=>'required|date',
         'date_fin'=>'required|date',
         'employe_id'=>'required',
         
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $code = $request->input('code');
             $date_deb = $request->input('date_deb');
             $date_fin = $request->input('date_fin');
             $validation = $request->input('validation');
             $employe_id = $request->input('employe_id');
 
            
             // Create a new instance of the demande_conges model
             $demande_conge = new demande_conge();
     
             // Set the values of the model attributes
             $demande_conge->code = $code;
             $demande_conge->date_deb = $date_deb;
             $demande_conge->date_fin = $date_fin;
             $demande_conge->validation = $validation;
             $demande_conge->employe_id = $employe_id;
 
 
             $demande_conge->updated_at = now();
             $demande_conge->created_at = now();
     
     
             $demande_conge->save();
             if($demande_conge){
                 return response()->json([
                     'status'=>200,
                     'message'=>"demande_conge created secsusflly"
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
      $demande_conge = demande_conge::find($id);
 
      if (!$demande_conge) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'demande_conge non trouvé'
         ], 404);
  }
 
 return response()->json($demande_conge, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        'code'=>'required|string|max:50',
        'date_deb'=>'required|date',
        'date_fin'=>'required|date',
        'employe_id'=>'required',
        
 
     ]);
 
     // Trouver l'demande_conges à mettre à jour
     $demande_conge = demande_conge::find($id);
 
     // Vérifier si l'demande_conges existe
     if (!$demande_conge) {
         return response()->json(['message' => 'demande_conge non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $demande_conge->code = $code;
     $demande_conge->date_deb = $date_deb;
     $demande_conge->date_fin = $date_fin;
     $demande_conge->validation = $validation;
     $demande_conge->employe_id = $employe_id;
 
  
     $demande_conge->updated_at = now();
 
     // Sauvegarder les modifications
     $demande_conges->save();
 
     // Retourner la réponse avec l'demande_conges mis à jour
     return response()->json([
         'message' => 'demande_conges mis à jour avec succès', 
         'demande_conge' => $demande_conge
     ]);
 }
 public function delete($id)
 {
  $demande_conges = demande_conges::find($id);
 
  if (!$demande_conges) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'demande_conges non trouvé'
     ], 404);
 }else {
     $demande_conges->delete();
     return response()->json([
     'message' => 'demande_conges supprimé avec succès'],
      200);
 }
 
 }
 }
 