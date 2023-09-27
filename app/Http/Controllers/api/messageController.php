<?php

namespace App\Http\Controllers\api;

use App\Models\message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    //
    public function index()  {
        $messages = Message::with('famille')->get();
        if($messages->count()>0)
        return response()->json([
            'status'=>200,
            'messages'=>$messages
           ],200);
       
       else 
        return response()->json([
            'status'=>404,
            'messages'=>' aucun messages'
           ],404);
    
    
      
    }
    public function ajouter(Request $request){
     $validator= Validator::make($request->all(),[
        'date_message'=>'required',
        'objet_message'=>'required|string|max:50',
        'contenu'=>'required|string|max:50',
        'famille_id'=>'required',
        'etat'=>'required',


     ]); 
        if ($validator->fails()) {
            return response()->json([
                'status'=>422,
                'ERRORRS'=>$validator->messages() 
               ],422);
        }else {
            $date_message = $request->input('date_message');
            $objet_message = $request->input('objet_message');
            $contenu = $request->input('contenu');
            $famille_id = $request->input('famille_id');
            $etat = $request->input('etat');


            // Create a new instance of the message model
            $message = new message();
    
            // Set the values of the model attributes
            $message->date_message = $date_message;
            $message->objet_message = $objet_message;
            $message->contenu = $contenu;
            $message->famille_id = $famille_id;
            $message->etat = $etat;

            $message->updated_at = now();
            $message->created_at = now();
    
    
            $message->save();
            if($message){
                return response()->json([
                    'status'=>200,
                    'message'=>"message created secsusflly"
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
     $message = message::find($id);

     if (!$message) {
        return response()->json(
            [ 'status'=>404,
            'message' => 'message non trouvé'
        ], 404);
 }

return response()->json($message, 200);
}
public function update(Request $request, $id)
{
    // Valider les données du formulaire de mise à jour
    $request->validate([
        'date_message' => 'required',
        'objet_message' => 'required|string|max:50',
        'contenu' => 'required|string|max:50',
        'famille_id' => 'required',
        'etat' => 'required', // Assurez-vous que 'etat' est bien défini dans le formulaire
    ]);

    // Trouver l'message à mettre à jour
    $message = Message::find($id);

    // Vérifier si l'message existe
    if (!$message) {
        return response()->json(['message' => 'message non trouvé'], 404);
    }

    // Mettre à jour les champs avec les nouvelles valeurs
    $message->objet_message = $request->input('objet_message');
    $message->contenu = $request->input('contenu');
    $message->famille_id = $request->input('famille_id');
    $message->etat = $request->input('etat'); // Assurez-vous que 'etat' est bien défini dans le formulaire
    $message->date_message = $request->input('date_message');

    // Sauvegarder les modifications
    $message->save();

    // Retourner la réponse avec l'message mis à jour
    return response()->json([
        'message' => 'message mis à jour avec succès',
        'message' => $message
    ]);
}

public function delete($id)
{
 $message = message::find($id);

 if (!$message) {
    return response()->json(
        [ 'status'=>404,
        'message' => 'message non trouvé'
    ], 404);
}else {
    $message->delete();
    return response()->json([
    'message' => 'message supprimé avec succès'],
     200);
}

}
public function messageformamille($idf)  {
    $messages= message::where('famille_id',$idf)->get();
    if($messages->count()>0)
     return response()->json([
         'status'=>200,
         'messages'=>$messages
        ],200);
    
    else 
     return response()->json([
         'status'=>404,
         'messages'=>' aucun messages for Famille'
        ],404);
 
 
   
 }
}
