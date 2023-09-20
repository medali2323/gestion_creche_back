<?php

namespace App\Http\Controllers\api;

use App\Models\ligne_facture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LigneFactureController extends Controller
{
    public function index()  {
        $ligne_factures= ligne_facture::all();
        if($ligne_factures->count()>0)
         return response()->json([
             'status'=>200,
             'ligne_factures'=>$ligne_factures
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'ligne_factures'=>' aucun ligne_factures'
            ],404);
     
     
       
     }
     public function getlignesforfacture($idf)  {
        $ligne_factures= ligne_facture::where('facture_id',$idf)->get();
        if($ligne_factures->count()>0)
         return response()->json([
             'status'=>200,
             'ligne_factures'=>$ligne_factures
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'ligne_factures'=>' aucun ligne_factures'
            ],404);
     
     
       
     }
     public function ajouter(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50',
            'inscription_id' => 'required',
            'facture_id' => 'required',
            'mois_facturation' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'ERRORRS' => $validator->messages()
            ], 422);
        } else {
            $code = $request->input('code');
            $inscription_id = $request->input('inscription_id');
            $facture_id = $request->input('facture_id');
            $mois_facturation = $request->input('mois_facturation');
    
            // Vérifier si une ligne de facturation existe déjà pour cette inscription et ce mois
            $existingLigneFacture = ligne_facture::where('inscription_id', $inscription_id)
                ->where('mois_facturation', $mois_facturation)
                ->first();
    
            if ($existingLigneFacture) {
                return response()->json([
                    'status' => 422,
                    'message' => 'Une ligne de facturation existe déjà pour cette inscription ce mois-ci.'
                ], 422);
            }
    
            // Créer une nouvelle instance du modèle ligne_facture
            $ligne_facture = new ligne_facture();
    
            // Définir les valeurs des attributs du modèle
            $ligne_facture->code = $code;
            $ligne_facture->inscription_id = $inscription_id;
            $ligne_facture->facture_id = $facture_id;
            $ligne_facture->mois_facturation = $mois_facturation;
            $ligne_facture->updated_at = now();
            $ligne_facture->created_at = now();
    
            $ligne_facture->save();
            if ($ligne_facture) {
                return response()->json([
                    'status' => 200,
                    'message' => "ligne_facture created successfully",
                    'ligne_facture' => $ligne_facture
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Un problème est survenu quelque part"
                ], 500);
            }
        }
    }
    public function checkIfLigneFactureExists($inscriptionId, $moisFacturation)
    {
        // Utilisez la méthode "first" au lieu de "exists" pour obtenir un modèle ou null
        $ligneFacture = ligne_facture::where('inscription_id', $inscriptionId)
            ->where('mois_facturation', $moisFacturation)
            ->first();
    
        // Si une ligne de facture existe, retournez true, sinon retournez false
        if ($ligneFacture !== null) {
            return response()->json([
                'status' => 422,
                'facture' => "Ligne facture existe"
            ], 422);
        }else {
            return response()->json([
                'status' => 200,
                'facture' => "Ligne facture  non existe"
            ], 200);
        }
    }
    
     public function getById($id){
      $ligne_facture = ligne_facture::find($id);
 
      if (!$ligne_facture) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'ligne_facture non trouvé'
         ], 404);
  }
 
 return response()->json($ligne_facture, 200);
 }
     public function update(Request $request, $id)
 {
     // Valider les données du formulaire de mise à jour
     $request->validate([
        'code'=>'required|string|max:50',
        'inscription_id' => 'required',
        'facture_id' => 'required',
        'mois_facturation' => 'required'
    
 
     ]);
 
     // Trouver l'ligne_facture à mettre à jour
     $ligne_facture = ligne_facture::find($id);
 
     // Vérifier si l'ligne_facture existe
     if (!$ligne_facture) {
         return response()->json(['message' => 'ligne_facture non trouvé'], 404);
     }
 
     // Mettre à jour les champs avec les nouvelles valeurs
     $ligne_facture->code = $code;
     $ligne_facture->inscription_id = $inscription_id;
     $ligne_facture->facture_id = $facture_id;
     $ligne_facture->mois_facturation = $mois_facturation;

     $ligne_facture->updated_at = now();
 
     // Sauvegarder les modifications
     $ligne_facture->save();
 
     // Retourner la réponse avec l'ligne_facture mis à jour
     return response()->json([
         'message' => 'ligne_facture mis à jour avec succès', 
         'ligne_facture' => $ligne_facture
     ]);
 }
 public function delete($id)
 {
  $ligne_facture = ligne_facture::find($id);
 
  if (!$ligne_facture) {
     return response()->json(
         [ 'status'=>404,
         'message' => 'ligne_facture non trouvé'
     ], 404);
 }else {
     $ligne_facture->delete();
     return response()->json([
     'message' => 'ligne_facture supprimé avec succès'],
      200);
 }
 
 }
 
 }
 
