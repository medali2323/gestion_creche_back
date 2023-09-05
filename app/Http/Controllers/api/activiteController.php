<?php

namespace App\Http\Controllers\api;

use App\Models\activite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class activiteController extends Controller
{
    //
    public function index()  {
       $activites= activite::all();
       if($activites->count()>0)
        return response()->json([
            'status'=>200,
            'activites'=>$activites
           ],200);
       
       else 
        return response()->json([
            'status'=>404,
            'activites'=>' aucun activites'
           ],404);
    
    
      
    }
    public function ajouter(Request $request){
     $validator= Validator::make($request->all(),[
        'nom'=>'required|string|max:50',
        'famille_id'=>'required',


     ]); 
        if ($validator->fails()) {
            return response()->json([
                'status'=>422,
                'ERRORRS'=>$validator->messages() 
               ],422);
        }else {
            $nom = $request->input('nom');
          

            // Create a new instance of the activite model
            $activite = new activite();
    
            // Set the values of the model attributes
            $activite->nom = $nom;
          
            $activite->updated_at = now();
            $activite->created_at = now();
    
    
            $activite->save();
            if($activite){
                return response()->json([
                    'status'=>200,
                    'message'=>"activite created secsusflly"
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
     $activite = activite::find($id);

     if (!$activite) {
        return response()->json(
            [ 'status'=>404,
            'message' => 'activite non trouvé'
        ], 404);
 }

return response()->json($activite, 200);
}
    public function update(Request $request, $id)
{
    // Valider les données du formulaire de mise à jour
    $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'dateness' => 'required|date',
        'famille_id'=>'required',

    ]);

    // Trouver l'activite à mettre à jour
    $activite = activite::find($id);

    // Vérifier si l'activite existe
    if (!$activite) {
        return response()->json(['message' => 'activite non trouvé'], 404);
    }

    // Mettre à jour les champs avec les nouvelles valeurs
    $activite->nom = $request->input('nom');
  
    // Sauvegarder les modifications
    $activite->save();

    // Retourner la réponse avec l'activite mis à jour
    return response()->json([
        'message' => 'activite mis à jour avec succès', 
        'activite' => $activite
    ]);
}
public function delete($id)
{
 $activite = activite::find($id);

 if (!$activite) {
    return response()->json(
        [ 'status'=>404,
        'message' => 'activite non trouvé'
    ], 404);
}else {
    $activite->delete();
    return response()->json([
    'message' => 'activite supprimé avec succès'],
     200);
}

}
}
