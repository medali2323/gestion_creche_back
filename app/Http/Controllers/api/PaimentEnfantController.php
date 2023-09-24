<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\paiment_enfant;
use Illuminate\Support\Facades\Validator;

class PaimentEnfantController extends Controller
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
        
        'facture_id'=>'required',
        'date_paiment'=>'required',
        'mode_paiment_id'=>'required',
        'montant_paiment'=>'required|numeric',



     ]); 
        if ($validator->fails()) {
            return response()->json([
                'status'=>422,
                'ERRORRS'=>$validator->messages() 
               ],422);
        }else {
            $facture_id = $request->input('facture_id');
            $date_paiment = $request->input('date_paiment');
            $mode_paiment_id = $request->input('mode_paiment_id');
            $montant_paiment = $request->input('montant_paiment');

            // Create a new instance of the paiment_enfant model
            $paiment_enfant = new paiment_enfant();
    
            // Set the values of the model attributes
            $paiment_enfant->facture_id = $facture_id;
            $paiment_enfant->date_paiment = $date_paiment;
            $paiment_enfant->mode_paiment_id = $mode_paiment_id;
            $paiment_enfant->montant_paiment = $montant_paiment;

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
        'facture_id'=>'required',
        'date_paiment'=>'required',
        'mode_paiment_id'=>'required',
        'montant_paiment'=>'required|numeric',


    ]);

    // Trouver l'paiment_enfant à mettre à jour
    $paiment_enfant = paiment_enfant::find($id);

    // Vérifier si l'paiment_enfant existe
    if (!$paiment_enfant) {
        return response()->json(['message' => 'paiment_enfant non trouvé'], 404);
    }

    // Mettre à jour les champs avec les nouvelles valeurs
    $paiment_enfant->facture_id = $request->input('facture_id');
    $paiment_enfant->date_paiment = $request->input('date_paiment');
    $paiment_enfant->mode_paiment_id = $request->input('mode_paiment_id');
    $paiment_enfant->montant_paiment = $request->input('montant_paiment');

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

// ...

public function getByFactureId($facture_id)
{
    // Utilisez la méthode where pour filtrer les paiements d'enfants par facture_id
    $paimentEnfants = paiment_enfant::where('facture_id', $facture_id)->first();

    if ($paimentEnfants->count() > 0) {
        return response()->json([
            'status' => 200,
            'paiment_enfants' => $paimentEnfants
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => 'Aucun paiement d\'enfant trouvé pour cette facture.'
        ], 404);
    }
}

}
