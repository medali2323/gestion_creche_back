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
        'nom_parent'=>'required|string|max:50',
        'prenom_parent'=>'required|string|max:50',
        'numero_telephone'=>'required|max:8',
        'numero_cin'=>'required|max:8',

     ]); 
        if ($validator->fails()) {
            return response()->json([
                'status'=>422,
                'ERRORRS'=>$validator->messages() 
               ],422);
        }else {
            $nom_parent = $request->input('nom_parent');
            $prenom_parent = $request->input('prenom_parent');
            $numero_telephone = $request->input('numero_telephone');
            $numero_cin = $request->input('numero_cin');

            // Create a new instance of the famille model
            $famille = new famille();
    
            // Set the values of the model attributes
            $famille->nom_parent = $nom_parent;
            $famille->prenom_parent = $prenom_parent;
            $famille->numero_telephone = $numero_telephone;
            $famille->numero_cin = $numero_cin;
            $famille->updated_at = now();
            $famille->created_at = now();
    
    
            $famille->save();
            if($famille){
                return response()->json([
                    'status'=>200,
                    'message'=>"famille created secsusflly"
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
        'nom_parent'=>'required|string|max:50',
        'prenom_parent'=>'required|string|max:50',
        'numero_telephone'=>'required|max:8',
        'numero_cin'=>'required|max:8',

    ]);

    // Trouver l'famille à mettre à jour
    $famille = famille::find($id);

    // Vérifier si l'famille existe
    if (!$famille) {
        return response()->json(['message' => 'famille non trouvé'], 404);
    }

    // Mettre à jour les champs avec les nouvelles valeurs
    $famille->nom_parent = $nom_parent;
    $famille->prenom_parent = $prenom_parent;
    $famille->numero_telephone = $numero_telephone;
    $famille->numero_cin = $numero_cin;

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
}
