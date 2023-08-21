<?php

namespace App\Http\Controllers;

use App\Models\pointage_enfant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PointageEnfantController extends Controller
{
    //
    public function index()  {
        $pointage_enfant= pointage_enfant::all();
        if($pointage_enfant->count()>0)
         return response()->json([
             'status'=>200,
             'pointage_enfant'=>$pointage_enfant
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'pointage_enfant'=>' aucun pointage_enfant'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
        'nom_activite' => 'required|string',
        'datepointage' => 'required|date',
        'heurepointage' => 'required|date_format:H:i',
        'enfant_id' => 'required',
        'employe_enfant_id' => 'required'
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $nom_activite = $request->input('nom_activite');
             $datepointage = $request->input('datepointage');
             $heurepointage = $request->input('heurepointage');
             $enfant_id = $request->input('enfant_id');
             $employe_enfant_id = $request->input('employe_enfant_id');

 
             // Create a new instance of the pointage_enfant model
             $pointage_enfant = new pointage_enfant();
     
             // Set the values of the model attributes
             $pointage_enfant->nom_activite = $nom_activite;
             $pointage_enfant->datepointage = $datepointage;
             $pointage_enfant->heurepointage = $heurepointage;
             $pointage_enfant->enfant_id = $enfant_id;
             $pointage_enfant->employe_enfant_id = $employe_enfant_id;

             $pointage_enfant->updated_at = now();
             $pointage_enfant->created_at = now();
     
     
             $pointage_enfant->save();
             if($pointage_enfant){
                 return response()->json([
                     'status'=>200,
                     'message'=>"pointage_enfant created secsusflly"
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
      $pointage_enfant = pointage_enfant::find($id);
 
      if (!$pointage_enfant) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'pointage_enfant non trouvé'
         ], 404);
  }
 
 return response()->json($pointage_enfant, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        $nom_activite = $request->input('nom_activite'),
        $datepointage = $request->input('datepointage'),
        $heurepointage = $request->input('heurepointage'),
        $enfant_id = $request->input('enfant_id'),
        $employe_enfant_id = $request->input('employe_enfant_id')
        
     ]);
 
     // Trouver l'pointage_enfant à mettre à jour
     $pointage_enfant = pointage_enfant::find($id);
 
     // Vérifier si l'pointage_enfant existe
     if (!$pointage_enfant) {
         return response()->json(['message' => 'pointage_enfant non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $pointage_enfant->nom_activite = $request->input('nom_activite');
     $pointage_enfant->datepointage = $request->input('datepointage');
     $pointage_enfant->heurepointage = $request->input('heurepointage');
     $pointage_enfant->enfant_id = $request->input('enfant_id');
     $pointage_enfant->employe_enfant_id = $request->input('employe_enfant_id');
    
 
     // Sauvegarder les modifications
     $pointage_enfant->save();
 
     // Retourner la réponse avec l'pointage_enfant mis à jour
     return response()->json([
         'message' => 'pointage_enfant mis à jour avec succès', 
         'pointage_enfant' => $pointage_enfant
     ]);
 }
 public function delete($id){
  $pointage_enfant = pointage_enfant::find($id);
 
  if (!$pointage_enfant) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'pointage_enfant non trouvé'
     ], 404);
 }
 else {
     $pointage_enfant->delete();
     return response()->json([
     'message' => 'pointage_enfant supprimé avec succès'],
      200);
 }
 
 }
 public function pointageforenfant($idenf)  {
    $pointage_enfants= pointage_enfant::where('enfant_id',$idenf)->get();
    if($pointage_enfants->count()>0)
     return response()->json([
         'status'=>200,
         'pointage_enfants'=>$pointage_enfants
        ],200);
    
    else 
     return response()->json([
         'status'=>404,
         'pointage_enfants'=>' aucun pointage_enfants for enfant'
        ],404);
 }
}

