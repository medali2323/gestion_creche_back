<?php

namespace App\Http\Controllers\api;

use App\Models\employe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class employeController extends Controller
{
    //
    public function index()  {
        $employe= employe::all();
        if($employe->count()>0)
         return response()->json([
             'status'=>200,
             'employe'=>$employe
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'employe'=>' aucun employe'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
        'nom_employe'=>'required|string|max:50',
        'prenom_employe'=>'required|string|max:50',
        'dateness'=>'required|date',
        'num_cin'=>'required|max:8',
        'numero_tel'=>'required|max:8',
        'adresse'=>'required',
        'email'=>'required|email',
        'niveau_scolaire'=>'required',
        'date_emboche'=>'required|date',
        'role'=>'required'

 
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
             $numero_tel = $request->input('numero_tel');
             $adresse = $request->input('adresse');
             $email = $request->input('email');
             $niveau_scolaire = $request->input('niveau_scolaire');
             $date_emboche = $request->input('date_emboche');
             $role = $request->input('role');

 
             // Create a new instance of the employe model
             $employe = new employe();
     
             // Set the values of the model attributes
             $employe->nom_employe = $nom_employe;
             $employe->prenom_employe = $prenom_employe;
             $employe->date_ness = $date_ness;
             $employe->num_cin = $num_cin;
             $employe->numero_tel = $numero_tel;
             $employe->adresse = $adresse;
             $employe->niveau_scolaire = $niveau_scolaire;
             $employe->date_emboche = $date_emboche;
             $employe->role = $role;
             $employe->updated_at = now();
             $employe->created_at = now();
     
     
             $employe->save();
             if($employe){
                 return response()->json([
                     'status'=>200,
                     'message'=>"employe created secsusflly"
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
      $employe = employe::find($id);
 
      if (!$employe) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'employe non trouvé'
         ], 404);
  }
 
 return response()->json($employe, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        'nom_employe'=>'required|string|max:50',
        'prenom_employe'=>'required|string|max:50',
        'dateness'=>'required|date',
        'num_cin'=>'required|max:8',
        'numero_tel'=>'required|max:8',
        'adresse'=>'required',
        'email'=>'required|email',
        'niveau_scolaire'=>'required',
        'date_emboche'=>'required|date',
        'role'=>'required'
        
     ]);
 
     // Trouver l'employe à mettre à jour
     $employe = employe::find($id);
 
     // Vérifier si l'employe existe
     if (!$employe) {
         return response()->json(['message' => 'employe non trouvé'], 404);
     }
     $nom_employe = $request->input('nom_employe');
     $prenom_employe = $request->input('prenom_employe');
     $date_ness = $request->input('date_ness');
     $numero_tel = $request->input('numero_tel');
     $adresse = $request->input('adresse');
     $email = $request->input('email');
     $niveau_scolaire = $request->input('niveau_scolaire');
     $date_emboche = $request->input('date_emboche');
     $role = $request->input('role');
     // Mettre à jour les champs avec les nouvelles valeurs
     $employe->nom_employe = $nom_employe;
     $employe->prenom_employe = $prenom_employe;
     $employe->date_ness = $date_ness;
     $employe->num_cin = $num_cin;
     $employe->numero_tel = $numero_tel;
     $employe->adresse = $adresse;
     $employe->niveau_scolaire = $niveau_scolaire;
     $employe->date_emboche = $date_emboche;
     $employe->role = $role;
     $employe->updated_at = now();
    

    
 
     // Sauvegarder les modifications
     $employe->save();
 
     // Retourner la réponse avec l'employe mis à jour
     return response()->json([
         'message' => 'employe mis à jour avec succès', 
         'employe' => $employe
     ]);
 }
 public function delete($id){
  $employe = employe::find($id);
 
  if (!$employe) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'employe non trouvé'
     ], 404);
 }
 else {
     $employe->delete();
     return response()->json([
     'message' => 'employe supprimé avec succès'],
      200);
 }
 
 }
  
}
