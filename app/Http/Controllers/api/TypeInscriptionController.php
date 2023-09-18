<?php

namespace App\Http\Controllers\api;


use App\Models\type_inscriptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class TypeInscriptionController extends Controller
{
    public function index()  {
        $type_inscriptionss= type_inscriptions::all();
        if($type_inscriptionss->count()>0)
         return response()->json([
             'status'=>200,
             'type_inscriptionss'=>$type_inscriptionss
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'type_inscriptionss'=>' aucun type_inscriptionss'
            ],404);
     
     
       
     }
    
     public function ajouter(Request $request){
      $validator= Validator::make($request->all(),[
         'code'=>'required|string|max:50',
         'libelle' => 'required|string|max:50',
         'prix_inscription' => 'numeric', // Correctly spelled as 'numeric'
 
      ]); 
         if ($validator->fails()) {
             return response()->json([
                 'status'=>422,
                 'ERRORRS'=>$validator->messages() 
                ],422);
         }else {
             $code = $request->input('code');
             $prix_inscription = $request->input('prix_inscription');
             $libelle = $request->input('libelle');

            
          
             // Create a new instance of the type_inscriptions model
             $type_inscriptions = new type_inscriptions();
     
             // Set the values of the model attributes
             $type_inscriptions->code = $code;
             $type_inscriptions->prix_inscription = $prix_inscription;
            
             $type_inscriptions->libelle = $libelle;

             $type_inscriptions->updated_at = now();
             $type_inscriptions->created_at = now();
     
     
             $type_inscriptions->save();
             if($type_inscriptions){
                 return response()->json([
                     'status'=>200,
                     'message'=>"type_inscriptions created secsusflly"
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
      $type_inscriptions = type_inscriptions::find($id);
 
      if (!$type_inscriptions) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'type_inscriptions non trouvé'
         ], 404);
  }
 
 return response()->json($type_inscriptions, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        'code'=>'required|string|max:50',
         'libelle' => 'required|string|max:50',
         'prix_inscription' => 'required|numeric',
 
 
     ]);
 
     // Trouver l'type_inscriptions à mettre à jour
     $type_inscriptions = type_inscriptions::find($id);
 
     // Vérifier si l'type_inscriptions existe
     if (!$type_inscriptions) {
         return response()->json(['message' => 'type_inscriptions non trouvé'], 404);
     }
     $code = $request->input('code');
     $prix_inscription = $request->input('prix_inscription');
     $libelle = $request->input('libelle');

     // Mettre à jour les champs avec les nouvelles valeurs
     $type_inscriptions->code = $code;
     $type_inscriptions->prix_inscription = $prix_inscription;
     $type_inscriptions->libelle = $libelle;

     $type_inscriptions->updated_at = now();
 
     // Sauvegarder les modifications
     $type_inscriptions->save();
 
     // Retourner la réponse avec l'type_inscriptions mis à jour
     return response()->json([
         'message' => 'type_inscriptions mis à jour avec succès', 
         'type_inscriptions' => $type_inscriptions
     ]);
 }
 public function delete($id)
 {
  $type_inscriptions = type_inscriptions::find($id);
 
  if (!$type_inscriptions) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'type_inscriptions non trouvé'
     ], 404);
 }else {
     $type_inscriptions->delete();
     return response()->json([
     'message' => 'type_inscriptions supprimé avec succès'],
      200);
 }
 
 }
 }
 
