<?php

namespace App\Http\Controllers\api;

use App\Models\absence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AbsenceController extends Controller
{
  
    public function index()  {
        $absences= absence::all();
        if($absences->count()>0)
         return response()->json([
             'status'=>200,
             'absences'=>$absences
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'absences'=>' aucun absences'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
         'code'=>'required|string|max:50',
         'date'=>'required|date',
         'cause '=>'required|string',
         'employe_id'=>'required',
         
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $code = $request->input('code');
             $date = $request->input('date');
             $cause = $request->input('cause');
             $employe_id = $request->input('employe_id');
 
            
             // Create a new instance of the absence model
             $absence = new absence();
     
             // Set the values of the model attributes
             $absence->code = $code;
             $absence->date = $date;
             $absence->cause = $cause;
             $absence->employe_id = $employe_id;
 
 
             $absence->updated_at = now();
             $absence->created_at = now();
     
     
             $absence->save();
             if($absence){
                 return response()->json([
                     'status'=>200,
                     'message'=>"absence created secsusflly"
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
      $absence = absence::find($id);
 
      if (!$absence) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'absence non trouvé'
         ], 404);
  }
 
 return response()->json($absence, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        'code'=>'required|string|max:50',
        'date'=>'required|date',
        'cause '=>'required|string',
        'employe_id'=>'required',
        
 
     ]);
 
     // Trouver l'absence à mettre à jour
     $absence = absence::find($id);
 
     // Vérifier si l'absence existe
     if (!$absence) {
         return response()->json(['message' => 'absence non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $absence->code = $code;
     $absence->date = $date;
     $absence->cause = $cause;
     $absence->employe_id = $employe_id;
 
  
     $absence->updated_at = now();
 
     // Sauvegarder les modifications
     $absence->save();
 
     // Retourner la réponse avec l'absence mis à jour
     return response()->json([
         'message' => 'absence mis à jour avec succès', 
         'absence' => $absence
     ]);
 }
 public function delete($id)
 {
  $absence = absence::find($id);
 
  if (!$absence) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'absence non trouvé'
     ], 404);
 }else {
     $absence->delete();
     return response()->json([
     'message' => 'absence supprimé avec succès'],
      200);
 }
 
 }


public function absencebydate($date) {
    // Vérifier si la date a été fournie
    if (!$date) {
        return response()->json([
            'status' => 400,
            'message' => 'Veuillez fournir une date valide.',
        ], 400);
    }

    // Récupérer les absences pour la date spécifiée
    $absences = absence::where('date_absence', $date)->get();

    // Vérifier si des absences ont été trouvées
    if ($absences->count() > 0) {
        return response()->json([
            'status' => 200,
            'absences' => $absences,
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => 'Aucune absence trouvée pour la date spécifiée.',
        ], 404);
    }
}

 }
 