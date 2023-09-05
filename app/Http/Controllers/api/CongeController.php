<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CongeController extends Controller
{
    public function index()  {
        $conges= conge::all();
        if($conges->count()>0)
         return response()->json([
             'status'=>200,
             'conges'=>$conges
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'conges'=>' aucun conges'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
         'code'=>'required|string|max:50',
         'date_deb'=>'required|date',
         'date_fin '=>'required|date',
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
             $employe_id = $request->input('employe_id');
 
            
             // Create a new instance of the conge model
             $conge = new conge();
     
             // Set the values of the model attributes
             $conge->code = $code;
             $conge->date_deb = $date_deb;
             $conge->date_fin = $date_fin;
             $conge->employe_id = $employe_id;
 
 
             $conge->updated_at = now();
             $conge->created_at = now();
     
     
             $conge->save();
             if($conge){
                 return response()->json([
                     'status'=>200,
                     'message'=>"conge created secsusflly"
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
      $conge = conge::find($id);
 
      if (!$conge) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'conge non trouvé'
         ], 404);
  }
 
 return response()->json($conge, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        'code'=>'required|string|max:50',
        'date_deb'=>'required|date',
        'date_fin '=>'required|date',
        'employe_id'=>'required',
        
 
     ]);
 
     // Trouver l'conge à mettre à jour
     $conge = conge::find($id);
 
     // Vérifier si l'conge existe
     if (!$conge) {
         return response()->json(['message' => 'conge non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $conge->code = $code;
     $conge->date_deb = $date_deb;
     $conge->date_fin = $date_fin;
     $conge->employe_id = $employe_id;
 
  
     $conge->updated_at = now();
 
     // Sauvegarder les modifications
     $conge->save();
 
     // Retourner la réponse avec l'conge mis à jour
     return response()->json([
         'message' => 'conge mis à jour avec succès', 
         'conge' => $conge
     ]);
 }
 public function delete($id)
 {
  $conge = conge::find($id);
 
  if (!$conge) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'conge non trouvé'
     ], 404);
 }else {
     $conge->delete();
     return response()->json([
     'message' => 'conge supprimé avec succès'],
      200);
 }
 
 }
 }
 