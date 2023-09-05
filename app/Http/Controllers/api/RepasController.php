<?php

namespace App\Http\Controllers\api;

use App\Models\Repas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RepasController extends Controller
{
    //
    public function index()  {
        $Repass= Repas::all();
        if($Repass->count()>0)
         return response()->json([
             'status'=>200,
             'Repas'=>$Repass
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'Repass'=>' aucun Repass'
            ],404);
     
     
       
     }
    
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
         
         'libelle'=>'required',
        
 
 
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $libelle = $request->input('libelle');
 
             // Create a new instance of the Repas model
             $Repas = new Repas();
     
             // Set the values of the model attributes
             $Repas->libelle = $libelle;
           
 
             $Repas->updated_at = now();
             $Repas->created_at = now();
     
     
             $Repas->save();
             if($Repas){
                 return response()->json([
                     'status'=>200,
                     'message'=>"Repas created secsusflly"
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
      $Repas = Repas::find($id);
 
      if (!$Repas) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'Repas non trouvé'
         ], 404);
  }
 
 return response()->json($Repas, 200);
 }
 public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        $libelle = $request->input('libelle'),
       
        
     ]);
 
     // Trouver l'repas à mettre à jour
     $repas = Repas::find($id);
 
     // Vérifier si l'repas existe
     if (!$repas) {
         return response()->json(['message' => 'repas non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $repas->libelle = $request->input('libelle');
    
    
 
     // Sauvegarder les modifications
     $repas->save();
 
     // Retourner la réponse avec l'repas mis à jour
     return response()->json([
         'message' => 'repas mis à jour avec succès', 
         'repas' => $repas
     ]);
 }
 public function delete($id){
  $repas = Repas::find($id);
 
  if (!$repas) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'repas non trouvé'
     ], 404);
 }
 else {
     $repas->delete();
     return response()->json([
     'message' => 'repas supprimé avec succès'],
      200);
 }
 
}
}