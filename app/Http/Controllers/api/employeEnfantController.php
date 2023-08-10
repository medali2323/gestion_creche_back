<?php

namespace App\Http\Controllers\api;

use App\Models\employe_enfant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class employeEnfantController extends Controller
{
    //
    public function index()  {
        $employe_enfant= employe_enfant::all();
        if($employe_enfant->count()>0)
         return response()->json([
             'status'=>200,
             'employe_enfant'=>$employe_enfant
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'employe_enfant'=>' aucun employe_enfant'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
        'nom_employe'=>'required|string|max:50',
        'prenom_employe'=>'required|string|max:50',
        'dateness'=>'required',
        'num_cin'=>'required',
        'niveau_scolaire'=>'required',

        
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $nom_employe = $request->input('nom_employe');
             $prenom_employe = $request->input('prenom_employe');
             $date_ness = $request->input('date_ness');
             $num_cin = $request->input('num_cin');
             $niveau_scolaire = $request->input('niveau_scolaire');
            
 
             // Create a new instance of the employe_enfant model
             $employe_enfant = new employe_enfant();
     
             // Set the values of the model attributes
             $employe_enfant->nom_employe = $nom_employe;
             $employe_enfant->prenom_employe = $prenom_employe;
             $employe_enfant->date_ness = $date_ness;
             $employe_enfant->num_cin = $num_cin;
             $employe_enfant->niveau_scolaire = $niveau_scolaire;
             $employe_enfant->updated_at = now();
             $employe_enfant->created_at = now();
     
     
             $employe_enfant->save();
             if($employe_enfant){
                 return response()->json([
                     'status'=>200,
                     'message'=>"employe_enfant created secsusflly"
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
      $employe_enfant = employe_enfant::find($id);
 
      if (!$employe_enfant) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'employe_enfant non trouvé'
         ], 404);
  }
 
 return response()->json($employe_enfant, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        'nom_employe'=>'required|string|max:50',
        'prenom_employe'=>'required|string|max:50',
        'dateness'=>'required',
        'num_cin'=>'required',
        'niveau_scolaire'=>'required',
        
     ]);
 
     // Trouver l'employe_enfant à mettre à jour
     $employe_enfant = employe_enfant::find($id);
 
     // Vérifier si l'employe_enfant existe
     if (!$employe_enfant) {
         return response()->json(['message' => 'employe_enfant non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $nom_employe = $request->input('nom_employe');
     $prenom_employe = $request->input('prenom_employe');
     $date_ness = $request->input('date_ness');
     $num_cin = $request->input('num_cin');
     $niveau_scolaire = $request->input('niveau_scolaire');
    

    
 
     // Sauvegarder les modifications
     $employe_enfant->save();
 
     // Retourner la réponse avec l'employe_enfant mis à jour
     return response()->json([
         'message' => 'employe_enfant mis à jour avec succès', 
         'employe_enfant' => $employe_enfant
     ]);
 }
 public function delete($id){
  $employe_enfant = employe_enfant::find($id);
 
  if (!$employe_enfant) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'employe_enfant non trouvé'
     ], 404);
 }
 else {
     $employe_enfant->delete();
     return response()->json([
     'message' => 'employe_enfant supprimé avec succès'],
      200);
 }
 
 }
  
}
