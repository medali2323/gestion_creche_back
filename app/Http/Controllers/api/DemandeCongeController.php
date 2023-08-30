<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemandeCongeController extends Controller
{
    public function index()  {
        $demande_congess= demande_conges::all();
        if($demande_congess->count()>0)
         return response()->json([
             'status'=>200,
             'demande_congess'=>$demande_congess
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'demande_congess'=>' aucun demande_congess'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
         'code'=>'required|string|max:50',
         'date_deb'=>'required|date',
         'date_fin '=>'required|date',
         'validation'=>'required',
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
             $demande_conges = new demande_conges();
     
             // Set the values of the model attributes
             $demande_conges->code = $code;
             $demande_conges->date_deb = $date_deb;
             $demande_conges->date_fin = $date_fin;
             $demande_conges->validation = $validation;
             $demande_conges->employe_id = $employe_id;
 
 
             $demande_conges->updated_at = now();
             $demande_conges->created_at = now();
     
     
             $demande_conges->save();
             if($demande_conges){
                 return response()->json([
                     'status'=>200,
                     'message'=>"demande_conges created secsusflly"
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
      $demande_conges = demande_conges::find($id);
 
      if (!$demande_conges) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'demande_conges non trouvé'
         ], 404);
  }
 
 return response()->json($demande_conges, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        'code'=>'required|string|max:50',
        'date_deb'=>'required|date',
        'date_fin '=>'required|date',
        'validation'=>'required',
        'employe_id'=>'required',
        
 
     ]);
 
     // Trouver l'demande_conges à mettre à jour
     $demande_conges = demande_conges::find($id);
 
     // Vérifier si l'demande_conges existe
     if (!$demande_conges) {
         return response()->json(['message' => 'demande_conges non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $demande_conges->code = $code;
     $demande_conges->date_deb = $date_deb;
     $demande_conges->date_fin = $date_fin;
     $demande_conges->validation = $validation;
     $demande_conges->employe_id = $employe_id;
 
  
     $demande_conges->updated_at = now();
 
     // Sauvegarder les modifications
     $demande_conges->save();
 
     // Retourner la réponse avec l'demande_conges mis à jour
     return response()->json([
         'message' => 'demande_conges mis à jour avec succès', 
         'demande_conges' => $demande_conges
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
 