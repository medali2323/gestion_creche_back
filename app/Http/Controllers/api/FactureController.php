<?php

namespace App\Http\Controllers\api;

use App\Models\facture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FactureController extends Controller
{
  
    public function index()
    {
        $factures = facture::orderByDesc('date_facturation')->get();
    
        if ($factures->count() > 0) {
            return response()->json([
                'status' => 200,
                'factures' => $factures
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'factures' => 'aucun factures'
            ], 404);
        }
    }
    public function ajouter(Request $request){
        $validator= Validator::make($request->all(),[
           'code'=>'required|string|max:50',
           'montant_total' => 'required|numeric',
           'date_facturation' => 'required|date',
           'tva_id'=>'required',
           'etat_paiment' => 'required'
  
   
        ]); 
           if ($validator->fails()) {
               return response()->json([
                   'status'=>422,
                   'ERRORRS'=>$validator->messages() 
                  ],422);
           }else {
               $code = $request->input('code');
               $montant_total = $request->input('montant_total');
               $date_facturation = $request->input('date_facturation');
               $tva_id = $request->input('tva_id');
               $etat_paiment = $request->input('etat_paiment');
  
               // Create a new instance of the facture model
               $facture = new facture();
       
               // Set the values of the model attributes
               $facture->code = $code;
               $facture->montant_total = $montant_total;
               $facture->date_facturation = $date_facturation;
               $facture->tva_id = $tva_id;
               $facture->etat_paiment = $etat_paiment;
  
   
               $facture->updated_at = now();
               $facture->created_at = now();
       
       
               $facture->save();
               if($facture){
                   return response()->json([
                       'status'=>200,
                       'message'=>"facture created secsusflly",
                       'facture' => $facture
  
                      ],200);
               }else{
                   return response()->json([
                       'status'=>500,
                       'message'=>"un problem quelque part"
                      ],500);
               }
           }
       }
  

 public function update(Request $request, $id)
{
    // Valider les données du formulaire de mise à jour
    $request->validate([
        'code' => 'required|string|max:50',
        'montant_total' => 'required|numeric',
        'date_facturation' => 'required|date',
        'tva_id' => 'required',
        'etat_paiment' => 'required'

    ]);

    // Trouver l'facture à mettre à jour
    $facture = facture::find($id);

    // Vérifier si l'facture existe
    if (!$facture) {
        return response()->json(['message' => 'facture non trouvé'], 404);
    }

    // Mettre à jour les champs avec les nouvelles valeurs de la requête
    $facture->code = $request->input('code');
    $facture->montant_total = $request->input('montant_total');
    $facture->date_facturation = $request->input('date_facturation');
    $facture->tva_id = $request->input('tva_id');
    $facture->etat_paiment = $request->input('etat_paiment');

    $facture->updated_at = now();

    // Sauvegarder les modifications
    $facture->save();

    // Retourner la réponse avec l'facture mis à jour
    return response()->json([
        'message' => 'facture mis à jour avec succès',
        'facture' => $facture
    ]);
}

 public function delete($id)
 {
  $facture = facture::find($id);
 
  if (!$facture) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'facture non trouvé'
     ], 404);
 }else {
     $facture->delete();
     return response()->json([
     'message' => 'facture supprimé avec succès'],
      200);
 }
 
 }
 
    public function nvcodefacture()
{
    $lastFactureId = facture::max('id') + 1;
    $currentYear = date('Y');
    $lastTwoDigits = substr($currentYear, -2);

    $combinedResult = "FV ". $lastTwoDigits ."-". $lastFactureId;

    return response()->json(['nvcodefacture' => $combinedResult]);
}
public function getById($id){
    $facture = facture::find($id);

    if (!$facture) {
       return response()->json(
           [ 'status'=>404,
           'message' => 'facture non trouvé'
       ], 404);
}

return response()->json($facture, 200);
}
 }
 
