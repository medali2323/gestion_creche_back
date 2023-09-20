<?php

namespace App\Http\Controllers\api;

use App\Models\famille;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FamilleController extends Controller
{
    //
    public function index()  {
       $familles= famille::all();
       if($familles->count()>0)
        return response()->json([
            'status'=>200,
            'familles'=>$familles
           ],200);
       
       else 
        return response()->json([
            'status'=>404,
            'familles'=>' aucun familles'
           ],404);
    
    
      
    }
    public function ajouter(Request $request){
        $validator= Validator::make($request->all(),[
            'nom_pere'=>'required|string|max:50',
            'prenom_pere'=>'required|string|max:50',
            'numero_telephone_pere'=>'required|max:8',
            'numero_cin_pere'=>'required|max:8|unique:famille,numero_cin_pere',
            'email_pere' => 'required|email|unique:famille,email_pere', 
            'adresse_pere'=>'required',
            'nom_mere'=>'required|string|max:50',
            'prenom_mere'=>'required|string|max:50',
            'numero_telephone_mere'=>'required|max:8',
            'numero_cin_mere'=>'required|max:8|unique:famille,numero_cin_mere',
            'email_mere' => 'required|email|unique:famille,email_mere', 
            'adresse_mere'=>'required'
    
         ]); 
        if ($validator->fails()) {
            return response()->json([
                'status'=>422,
                'ERRORRS'=>$validator->messages() 
               ],422);
        }else {
            
            $nom_pere = $request->input('nom_pere');
            $prenom_pere = $request->input('prenom_pere');
            $numero_telephone_pere = $request->input('numero_telephone_pere');
            $numero_cin_pere = $request->input('numero_cin_pere');
            $email_pere = $request->input('email_pere');
            $adresse_pere = $request->input('adresse_pere');

            $nom_mere = $request->input('nom_mere');
            $prenom_mere = $request->input('prenom_mere');
            $numero_telephone_mere = $request->input('numero_telephone_mere');
            $numero_cin_mere = $request->input('numero_cin_mere');
            $email_mere = $request->input('email_mere');
            $adresse_mere = $request->input('adresse_mere');
     

            // Create a new instance of the famille model
            $famille = new famille();
    
            // Set the values of the model attributes
            $famille->nom_pere = $nom_pere;
            $famille->prenom_pere = $prenom_pere;
            $famille->numero_telephone_pere = $numero_telephone_pere;
            $famille->numero_cin_pere = $numero_cin_pere;
            $famille->email_pere = $email_pere;
            $famille->adresse_pere = $adresse_pere;

            $famille->nom_mere = $nom_mere;
            $famille->prenom_mere = $prenom_mere;
            $famille->numero_telephone_mere = $numero_telephone_mere;
            $famille->numero_cin_mere = $numero_cin_mere;
            $famille->email_mere = $email_mere;
            $famille->adresse_mere = $adresse_mere;

            $famille->updated_at = now();
            $famille->created_at = now();
    
    
            $famille->save();
            if($famille){
                return response()->json([
                    'status'=>200,
                    'message'=>"famille created secsusflly",
                    'idf' => $famille->id
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
     $famille = famille::find($id);

     if (!$famille) {
        return response()->json(
            [ 'status'=>404,
            'message' => 'famille non trouvé'
        ], 404);
 }

return response()->json($famille, 200);
}
    public function update(Request $request, $id)
{
    // Valider les données du formulaire de mise à jour
    $request->validate([
        'nom_pere'=>'required|string|max:50',
        'prenom_pere'=>'required|string|max:50',
        'numero_telephone_pere'=>'required|max:8',
        'numero_cin_pere'=>'required|max:8',
        'email_pere'=>'required|email',
        'adresse_pere'=>'required',
        'nom_mere'=>'required|string|max:50',
        'prenom_mere'=>'required|string|max:50',
        'numero_telephone_mere'=>'required|max:8',
        'numero_cin_mere'=>'required|max:8',
        'email_mere'=>'required|email',
        'adresse_mere'=>'required'

    ]);

    // Trouver l'famille à mettre à jour
    $famille = famille::find($id);

    // Vérifier si l'famille existe
    if (!$famille) {
        return response()->json(['message' => 'famille non trouvé'], 404);
    }

    // Mettre à jour les champs avec les nouvelles valeurs
    $famille->nom_pere = $nom_pere;
    $famille->prenom_pere = $prenom_pere;
    $famille->numero_telephone_pere = $numero_telephone_pere;
    $famille->numero_cin_pere = $numero_cin_pere;
    $famille->email_pere = $email_pere;
    $famille->adresse_pere = $adresse_pere;

    $famille->nom_mere = $nom_mere;
    $famille->prenom_mere = $prenom_mere;
    $famille->numero_telephone_mere = $numero_telephone_mere;
    $famille->numero_cin_mere = $numero_cin_mere;
    $famille->email_mere = $email_mere;
    $famille->adresse_mere = $adresse_mere;
    $famille->updated_at = now();

    // Sauvegarder les modifications
    $famille->save();

    // Retourner la réponse avec l'famille mis à jour
    return response()->json([
        'message' => 'famille mis à jour avec succès', 
        'famille' => $famille
    ]);
}
public function delete($id)
{
 $famille = famille::find($id);

 if (!$famille) {
    return response()->json(
        [ 'status'=>404,
        'message' => 'famille non trouvé'
    ], 404);
}else {
    $famille->delete();
    return response()->json([
    'message' => 'famille supprimé avec succès'],
     200);
}

}
public function existpere($numero_cin_pere)  {
    $familles= famille::where('numero_cin_pere',$numero_cin_pere)->get();
    if($familles->count()>0)
     return response()->json([
         'status'=>200,
         'familles'=>$familles
        ],200);
    
    else 
     return response()->json([
         'status'=>404,
         'familles'=>' aucun familles for enfant avec ce numero cin pere'
        ],404);
 }
 public function existmere($numero_cin_mere)  {
    $familles= famille::where('numero_cin_mere',$numero_cin_mere)->get();
    if($familles->count()>0)
     return response()->json([
         'status'=>200,
         'familles'=>$familles
        ],200);
    
    else 
     return response()->json([
         'status'=>404,
         'familles'=>' aucun familles for enfant avec ce numero cin mere'
        ],404);
 }
 public function nb_familles()
 {
     $sum = famille::count(); // Utilisez la fonction count() pour obtenir la somme des famille
     
     return response()->json(['nb_familles' => $sum]);
 }
 public function getFactures($familleId)
 {
     $famille = famille::with('facture')->find($familleId);

     // Maintenant, vous avez accès aux factures de la famille
     $factures = $famille->factures;

     // Faites quelque chose avec les factures (par exemple, les renvoyer en JSON)
     return response()->json(['facture' => $factures]);
 }
}
