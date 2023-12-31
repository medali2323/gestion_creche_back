<?php

namespace App\Http\Controllers\api;

use App\Models\dortoir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DortoirController extends Controller
{
    //
     public function index()  {
        $dortoirs= dortoir::all();
        if($dortoirs->count()>0)
         return response()->json([
             'status'=>200,
             'dortoirs'=>$dortoirs
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'dortoirs'=>' aucun dortoirs'
            ],404);
     
     
       
     }
     public function dortoirvide()  {
        $dortoirsVides = dortoir::whereNull('enfant.dortoir_id')
        ->leftJoin('enfant', 'dortoir.id', '=', 'enfant.dortoir_id')
        ->select('dortoir.*')
        ->get();        
        if($dortoirsVides->count()>0)
         return response()->json([
             'status'=>200,
             'dortoirvide'=>$dortoirsVides
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'dortoirs'=>' aucun dortoirs vide '
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
        
         'code'=>'required',
         'salle_id'=>'required|numeric'
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $code = $request->input('code');
             $salle_id = $request->input('salle_id');
            
             // Create a new instance of the dortoir model
             $dortoir = new dortoir();
     
             // Set the values of the model attributes
             $dortoir->code = $code;
             $dortoir->salle_id = $salle_id;
           
 
             $dortoir->updated_at = now();
             $dortoir->created_at = now();
     
     
             $dortoir->save();
             if($dortoir){
                 return response()->json([
                     'status'=>200,
                     'message'=>"dortoir created secsusflly"
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
      $dortoir = dortoir::find($id);
 
      if (!$dortoir) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'dortoir non trouvé'
         ], 404);
  }
 
 return response()->json($dortoir, 200);
 }
 public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
         'code' => 'required',
         'salle_id' => 'required'
     ]);
 
     // Trouver la dortoir à mettre à jour
     $dortoir = dortoir::find($id);
 
     // Vérifier si la dortoir existe
     if (!$dortoir) {
         return response()->json(['message' => 'dortoir non trouvée'], 404);
     }
 
     // Définir la variable $code à partir de la valeur de 'code' dans la requête
     $code = $request->input('code');
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $dortoir->code = $code;
     $dortoir->salle_id = $request->input('salle_id');
 
     $dortoir->updated_at = now();
     
     // Sauvegarder les modifications
     $dortoir->save();
 
     // Retourner la réponse avec la dortoir mise à jour
     return response()->json([
         'message' => 'dortoir mise à jour avec succès',
         'dortoir' => $dortoir
     ]);
 }
 public function delete($id)
 {
  $dortoir = dortoir::find($id);
 
  if (!$dortoir) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'dortoir non trouvé'
     ], 404);
 }else {
     $dortoir->delete();
     return response()->json([
     'message' => 'dortoir supprimé avec succès'],
      200);
 }
 
 }
 }
 