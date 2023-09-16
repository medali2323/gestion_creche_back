<?php

namespace App\Http\Controllers\api;

use App\Models\enfant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EnfantController extends Controller
{
    //
    public function index()  {
       $enfants= enfant::all();
       if($enfants->count()>0)
        return response()->json([
            'status'=>200,
            'enfants'=>$enfants
           ],200);
       
       else 
        return response()->json([
            'status'=>404,
            'enfants'=>' aucun enfants'
           ],404);
    
    
      
    }
    public function enfantformamille($idf)  {
        $enfants= enfant::where('famille_id',$idf)->get();
        if($enfants->count()>0)
         return response()->json([
             'status'=>200,
             'enfants'=>$enfants
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'enfants'=>' aucun enfants for Famille'
            ],404);
     
     
       
     }
     public function exist($nom,$prenom,$famille_id,$dateness)  {
        $enfants= enfant::where([
            ['non',$nom],
            ['prenom',$prenom],
            ['famille_id',$famille_id],
            ['dateness',$dateness],

        ])->get();
        if($enfants->count()>0)
         return true;
        else 
        return false;
     
     
       
     }
    public function ajouter(Request $request){
     $validator= Validator::make($request->all(),[
        'nom'=>'required|string|max:50',
        'prenom'=>'required|string|max:50',
        'dateness'=>'required',
        'etat_medical'=>'required',
        'adresse'=>'required',

        'famille_id'=>'required',


     ]); 
      // Vérification si l'enfant existe déjà
      $existingEnfant = Enfant::where('nom', $request->nom)
      ->where('prenom', $request->prenom)
      ->where('dateness', $request->dateness)
      ->where('famille_id', $request->famille_id)

      ->first();
      if ($existingEnfant) {
        return response()->json(['message' => 'Cet enfant existe déjà']);
    }else {
        if ($validator->fails() )  {
            return response()->json([
                'status'=>422,
                'ERRORRS'=>$validator->messages() 
               ],422);
        }else {
            $nom = $request->input('nom');
            $prenom = $request->input('prenom');
            $dateness = $request->input('dateness');
            $etat_medical = $request->input('etat_medical');
            $adresse = $request->input('adresse');

            $famille_id = $request->input('famille_id');
            $dortoir_id = $request->input('dortoir_id');

            // Create a new instance of the Enfant model
            $enfant = new Enfant();
            // Set the values of the model attributes
            $enfant->nom = $nom;
            $enfant->prenom = $prenom;
            $enfant->dateness = $dateness;
            $enfant->etat_medical = $etat_medical;
            $enfant->adresse = $adresse;

            $enfant->famille_id = $famille_id;
            $enfant->dortoir_id = $dortoir_id;

            $enfant->updated_at = now();
            $enfant->created_at = now();
    
    
            $enfant->save();
            if($enfant){
                return response()->json([
                    'status'=>200,
                    'message'=>"enfant created secsusflly"
                   ],200);
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>"un problem quelque part"
                   ],500);
            }
        }
    }
      
    }
    public function getById($id){
     $enfant = Enfant::find($id);

     if (!$enfant) {
        return response()->json(
            [ 'status'=>404,
            'message' => 'Enfant non trouvé'
        ], 404);
 }

return response()->json($enfant, 200);
}
    public function update(Request $request, $id)
{
    // Valider les données du formulaire de mise à jour
    $request->validate([
        'nom'=>'required|string|max:50',
        'prenom'=>'required|string|max:50',
        'dateness'=>'required',
        'etat_medical'=>'required',
        'adresse'=>'required',

        'famille_id'=>'required',


    ]);

    // Trouver l'enfant à mettre à jour
    $enfant = Enfant::find($id);

    // Vérifier si l'enfant existe
    if (!$enfant) {
        return response()->json(['message' => 'Enfant non trouvé'], 404);
    }

    // Mettre à jour les champs avec les nouvelles valeurs
    $enfant->nom = $request->input('nom');
    $enfant->prenom = $request->input('prenom');
    $enfant->dateness = $request->input('dateness');
    $enfant->etat_medical = $request->input('etat_medical');
    $enfant->adresse = $request->input('adresse');

    $enfant->famille_id = $request->input('famille_id');
    $enfant->dortoir_id = $request->input('dortoir_id');

    // Sauvegarder les modifications
    $enfant->save();

    // Retourner la réponse avec l'enfant mis à jour
    return response()->json([
        'message' => 'Enfant mis à jour avec succès', 
        'enfant' => $enfant
    ]);
}
public function delete($id)
{
 $enfant = Enfant::find($id);

 if (!$enfant) {
    return response()->json(
        [ 'status'=>404,
        'message' => 'Enfant non trouvé'
    ], 404);
}else {
    $enfant->delete();
    return response()->json([
    'message' => 'Enfant supprimé avec succès'],
     200);
}

}
public function nb_enfants()
    {
        $sum = Enfant::count(); // Utilisez la fonction count() pour obtenir la somme des enfants
        
        return response()->json(['nb_enfants' => $sum]);
    }
}
