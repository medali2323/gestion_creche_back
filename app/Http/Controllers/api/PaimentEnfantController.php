<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\paiment_enfant;

class Paiment_enfantController extends Controller
{
    //
    public function index()  {
       $paiment_enfants= paiment_enfant::all();
       if($paiment_enfants->count()>0)
        return response()->json([
            'status'=>200,
            'paiment_enfants'=>$paiment_enfants
           ],200);
       
       else 
        return response()->json([
            'status'=>404,
            'paiment_enfants'=>' aucun paiment_enfants'
           ],404);
    
    
      
    }
    public function ajouter(Request $request){
     $validator= Validator::make($request->all(),[
        
        'inscription_id'=>'required',
        'type_paiment_id'=>'required',
        'mode_paiment_id'=>'required',


     ]); 
        if ($validator->fails()) {
            return response()->json([
                'status'=>422,
                'ERRORRS'=>$validator->messages() 
               ],422);
        }else {
            $inscription_id = $request->input('inscription_id');
            $type_paiment_id = $request->input('type_paiment_id');
            $mode_paiment_id = $request->input('mode_paiment_id');

            // Create a new instance of the paiment_enfant model
            $paiment_enfant = new paiment_enfant();
    
            // Set the values of the model attributes
            $paiment_enfant->inscription_id = $inscription_id;
            $paiment_enfant->type_paiment_id = $type_paiment_id;
            $paiment_enfant->mode_paiment_id = $mode_paiment_id;

            $paiment_enfant->updated_at = now();
            $paiment_enfant->created_at = now();
    
    
            $paiment_enfant->save();
            if($paiment_enfant){
                return response()->json([
                    'status'=>200,
                    'message'=>"paiment_enfant created secsusflly"
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
     $paiment_enfant = paiment_enfant::find($id);

     if (!$paiment_enfant) {
        return response()->json(
            [ 'status'=>404,
            'message' => 'paiment_enfant non trouvé'
        ], 404);
 }

return response()->json($paiment_enfant, 200);
}
    public function update(Request $request, $id)
{
    // Valider les données du formulaire de mise à jour
    $request->validate([
        'inscription_id'=>'required',
        'type_paiment_id'=>'required',
        'mode_paiment_id'=>'required',

    ]);

    // Trouver l'paiment_enfant à mettre à jour
    $paiment_enfant = paiment_enfant::find($id);

    // Vérifier si l'paiment_enfant existe
    if (!$paiment_enfant) {
        return response()->json(['message' => 'paiment_enfant non trouvé'], 404);
    }

    // Mettre à jour les champs avec les nouvelles valeurs
    $paiment_enfant->inscription_id = $request->input('inscription_id');
    $paiment_enfant->type_paiment_id = $request->input('type_paiment_id');
    $paiment_enfant->mode_paiment_id = $request->input('mode_paiment_id');

    // Sauvegarder les modifications
    $paiment_enfant->save();

    // Retourner la réponse avec l'paiment_enfant mis à jour
    return response()->json([
        'message' => 'paiment_enfant mis à jour avec succès', 
        'paiment_enfant' => $paiment_enfant
    ]);
}
public function delete($id)
{
 $paiment_enfant = paiment_enfant::find($id);

 if (!$paiment_enfant) {
    return response()->json(
        [ 'status'=>404,
        'message' => 'paiment_enfant non trouvé'
    ], 404);
}else {
    $paiment_enfant->delete();
    return response()->json([
    'message' => 'paiment_enfant supprimé avec succès'],
     200);
}

}
}
