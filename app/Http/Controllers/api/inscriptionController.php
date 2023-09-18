<?php

namespace App\Http\Controllers\api;

use App\Models\inscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\anneescolaire;
use App\Models\enfant;

class inscriptionController extends Controller
{
    //
    public function index()  {
       $inscriptions= inscription::all();
       if($inscriptions->count()>0)
        return response()->json([
            'status'=>200,
            'inscriptions'=>$inscriptions
           ],200);
       
       else 
        return response()->json([
            'status'=>404,
            'inscriptions'=>' aucun inscriptions'
           ],404);
    
    
      
    }
    public function insritdeenfant(Request $request,$enfant_id,$anneescolaire_id)  {
        $inscriptions= inscription::where('enfant_id', $enfant_id)
        ->where('anneescolaire_id', $anneescolaire_id)
        ->first();
        if($inscriptions)
         return response()->json([
             'status'=>200,
             'inscriptions'=>$inscriptions
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'inscriptions'=>' aucun inscriptions'
            ],404);
     
     
       
     }
    public function ajouter(Request $request){
     $validator= Validator::make($request->all(),[
        'date_inscription'=>'required|date',
        'enfant_id'=>'required',

        'anneescolaire_id'=>'required',
        'type_inscriptions_id'=>'required',


     ]); 
        if ($validator->fails()) {
            return response()->json([
                'status'=>422,
                'ERRORRS'=>$validator->messages() 
               ],422);
        }else {
         
            $anneescolaire_id = $request->input('anneescolaire_id');
            $enfant_id = $request->input('enfant_id');
            $date_inscription = $request->input('date_inscription');
            $type_inscriptions_id = $request->input('type_inscriptions_id');

            // Create a new instance of the inscription model
            $inscription = new inscription();
    
            // Set the values of the model attributes
            $inscription->anneescolaire_id = $anneescolaire_id;
            $inscription->enfant_id = $enfant_id;
            $inscription->date_inscription = $date_inscription;
            $inscription->type_inscriptions_id = $type_inscriptions_id;


            $inscription->updated_at = now();
            $inscription->created_at = now();
    
    
            $inscription->save();
            if($inscription){
                return response()->json([
                    'status'=>200,
                    'message'=>"inscription created secsusflly"
                   ],201);
            }else{
                return response()->json([
                    'status'=>500,
                    'message'=>"un problem quelque part"
                   ],500);
            }
        }
    }
    public function getById($id){
     $inscription = inscription::find($id);

     if (!$inscription) {
        return response()->json(
            [ 'status'=>404,
            'message' => 'inscription non trouvé'
        ], 404);
 }

return response()->json($inscription, 200);
}
public function update(Request $request, $id)
{
    // Valider les données du formulaire de mise à jour
    $request->validate([
        'date_inscription'=>'required|date',
        'enfant_id'=>'required',

        'anneescolaire_id'=>'required',
        'type_inscriptions_id'=>'required',
    ]);

    // Trouver l'inscription à mettre à jour
    $inscription = inscription::find($id);

    // Vérifier si l'inscription existe
    if (!$inscription) {
        return response()->json(['message' => 'inscription non trouvé'], 404);
    }

    // Mettre à jour les champs avec les nouvelles valeurs
    $inscription->date_inscription = $request->input('date_inscription');
    $inscription->anneescolaire_id = $request->input('anneescolaire_id');
    $inscription->enfant_id = $request->input('enfant_id');

    $inscription->type_inscriptions_id = $request->input('type_inscriptions_id');

    // Sauvegarder les modifications
    $inscription->save();

    // Retourner la réponse avec l'inscription mis à jour
    return response()->json([
        'message' => 'inscription mis à jour avec succès', 
        'inscription' => $inscription
    ]);
}
public function delete($id)
{
 $inscription = inscription::find($id);

 if (!$inscription) {
    return response()->json(
        [ 'status'=>404,
        'message' => 'inscription non trouvé'
    ], 404);
}else {
    $inscription->delete();
    return response()->json([
    'message' => 'inscription supprimé avec succès'],
     200);
}

}

public function enfantsNonInscritsDansDerniereAnnee()
{
    // Trouver l'ID de la dernière année scolaire
    $derniereAnneeId = anneescolaire::latest('id')->first()->id;

    // Récupérer les enfants qui ne sont pas inscrits dans la dernière année scolaire
    $enfantsNonInscrits = enfant::whereDoesntHave('inscriptions', function ($query) use ($derniereAnneeId) {
        $query->where('anneescolaire_id', $derniereAnneeId);
    })->get();

    return response()->json($enfantsNonInscrits);
}
public function enfantsInscritsDansDerniereAnnee()
{
    // Trouver l'ID de la dernière année scolaire
    $derniereAnneeId = anneescolaire::latest('id')->first()->id;

    // Récupérer les enfants qui ne sont pas inscrits dans la dernière année scolaire
    $enfantsInscrits = enfant::whereHas('inscriptions', function ($query) use ($derniereAnneeId) {
        $query->where('anneescolaire_id', $derniereAnneeId);
    })
    ->with(['inscriptions' => function ($query) {
        $query->select('id', 'enfant_id', 'date_inscription', 'anneescolaire_id', 'type_inscriptions_id')
              ->with('typeInscription:id,libelle,prix_inscription'); // Charger l'objet "typeInscription" et sélectionner les colonnes requises
    }])
    ->get();

    // Renommer la clé "type_inscriptions_id" en "type_inscription"
    $enfantsInscrits->transform(function ($enfant) {
        $enfant->inscriptions->transform(function ($inscription) {
            $inscription->type_inscription = $inscription->typeInscription;
            unset($inscription->typeInscription);
            return $inscription;
        });
        return $enfant;
    });

    return response()->json($enfantsInscrits);
}

public function inscriptionsDerniereAnneeScolaire()
{
    // Étape 1 : Récupérez l'ID de la dernière année scolaire
    $derniereAnneeId = AnneeScolaire::latest('id')->first()->id;

    // Étape 2 : Récupérez les inscriptions de la dernière année scolaire avec les relations
    $inscriptionsDerniereAnnee = Inscription::where('anneescolaire_id', $derniereAnneeId)
        ->with('enfant.famille', 'typeInscription') // Charger les relations enfant et typeInscription
        ->get();

    // Maintenant, $inscriptionsDerniereAnnee contient les inscriptions de la dernière année scolaire avec les noms des enfants et les types d'inscription
    return response()->json($inscriptionsDerniereAnnee);
}

}
