<?php

namespace App\Http\Controllers\api;

use App\Models\anneescolaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class anneescolaireController extends Controller
{
    //
    public function index()  {
       $anneescolaire= anneescolaire::all();
       if($anneescolaire->count()>0)
        return response()->json([
            'status'=>200,
            'anneescolaire'=>$anneescolaire
           ],200);
       
       else 
        return response()->json([
            'status'=>404,
            'anneescolaire'=>' aucun anneescolaire'
           ],404);
    
    
      
    }
    public function ajouter(Request $request){
     $validator= Validator::make($request->all(),[
        'date_deb'=>'required|date',
        'date_fin'=>'required|date',
       

     ]); 
        if ($validator->fails()) {
            return response()->json([
                'status'=>422,
                'ERRORRS'=>$validator->messages() 
               ],422);
        }else {
            $date_deb = $request->input('date_deb');
            $date_fin = $request->input('date_fin');
           

            // Create a new instance of the anneescolaire model
            $anneescolaire = new anneescolaire();
    
            // Set the values of the model attributes
            $anneescolaire->date_deb = $date_deb;
            $anneescolaire->date_fin = $date_fin;
            $anneescolaire->updated_at = now();
            $anneescolaire->created_at = now();
    
    
            $anneescolaire->save();
            if($anneescolaire){
                return response()->json([
                    'status'=>200,
                    'message'=>"anneescolaire created secsusflly"
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
     $anneescolaire = anneescolaire::find($id);

     if (!$anneescolaire) {
        return response()->json(
            [ 'status'=>404,
            'message' => 'anneescolaire non trouvé'
        ], 404);
 }

return response()->json($anneescolaire, 200);
}
    public function update(Request $request, $id)
{
    // Valider les données du formulaire de mise à jour
    $request->validate([
        'date_deb' => 'required',
        'date_fin' => 'required',
       
    ]);

    // Trouver l'anneescolaire à mettre à jour
    $anneescolaire = anneescolaire::find($id);

    // Vérifier si l'anneescolaire existe
    if (!$anneescolaire) {
        return response()->json(['message' => 'anneescolaire non trouvé'], 404);
    }

    // Mettre à jour les champs avec les nouvelles valeurs
    $anneescolaire->date_deb = $request->input('date_deb');
    $anneescolaire->date_fin = $request->input('date_fin');
   

    // Sauvegarder les modifications
    $anneescolaire->save();

    // Retourner la réponse avec l'anneescolaire mis à jour
    return response()->json([
        'message' => 'anneescolaire mis à jour avec succès', 
        'anneescolaire' => $anneescolaire
    ]);
}
public function delete($id){
 $anneescolaire = anneescolaire::find($id);

 if (!$anneescolaire) {
    return response()->json(
        [ 'status'=>404,
        'message' => 'anneescolaire non trouvé'
    ], 404);
}
else {
    $anneescolaire->delete();
    return response()->json([
    'message' => 'anneescolaire supprimé avec succès'],
     200);
}

}
}
