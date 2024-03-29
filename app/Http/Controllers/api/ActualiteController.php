<?php

namespace App\Http\Controllers\api;

use App\Models\Actualite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class ActualiteController extends Controller
{
    
    public function ajouter(Request $request) {
        $imagesName = [];
        $response = [];
    
        $validator = Validator::make($request->all(),
            [
                'objet' => 'required',
                'pièce_jointe' => 'nullable|mimes:pdf|max:2048', // Rendre le champ pièce jointe optionnel
                'contenu' => 'required',
                'date' => 'required|date'
            ]
        );
    
        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "Validation error", "errors" => $validator->errors()]);
        }
    
        if($request->has('pièce_jointe')) {
            $img = $request->file('pièce_jointe');
            $filename = Str::random(32).".".$img->getClientOriginalExtension();
    
            $objet = $request->input('objet');
            $contenu = $request->input('contenu');
            $date = $request->input('date');
    
            $img->move('uploads/actualite', $filename);
    
            Actualite::create([
                'objet' => $objet,
                'pièce_jointe' => $filename,
                'contenu' => $contenu,
                'date' => $date
            ]);
    
            $response["status"] = "successs";
            $response["message"] = "Success! image(s) uploaded";
        } else {
            // Aucune pièce jointe fournie, mais toujours traitée comme un succès si les autres champs sont valides
            $objet = $request->input('objet');
            $contenu = $request->input('contenu');
            $date = $request->input('date');
    
            Actualite::create([
                'objet' => $objet,
                'contenu' => $contenu,
                'date' => $date
            ]);
    
            $response["status"] = "successs";
            $response["message"] = "Success! Actualité ajoutée sans pièce jointe";
        }
    
        return response()->json($response);
    }
    
    public function index()  {
        $Actualites= Actualite::all();
        if($Actualites->count()>0)
         return response()->json([
             'status'=>200,
             'Actualites'=>$Actualites
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'Actualites'=>' aucun Actualites'
            ],404);
     
     
       
     }
  
     
     
       
     


     public function update(Request $request, $id)
     {
         try {
             $actualite = Actualite::findOrFail($id);
     
             // Définissez un chemin de destination pour le téléchargement de la pièce jointe
             $destination = public_path("uploads/actualite/" . $actualite->piece_jointe);
     
             // Initialisez une variable pour le nom de fichier
             $filename = $actualite->piece_jointe;
     
             if ($request->hasFile('piece_jointe')) {
                 // Si une nouvelle pièce jointe est fournie, supprimez l'ancienne
                 if (File::exists($destination)) {
                     File::delete($destination);
                 }
     
                 // Téléchargez la nouvelle pièce jointe
                 $filename = $request->file('piece_jointe')->store('posts', 'public');
             }
     
             // Mettez à jour les autres champs
             $actualite->objet = $request->objet;
             $actualite->date = $request->date; // Assurez-vous que le format de la date est correct
             $actualite->contenu = $request->contenu;
             $actualite->piece_jointe = $filename;
     
             $result = $actualite->save();
     
             if ($result) {
                 return response()->json(['success' => true]);
             } else {
                 return response()->json(['success' => false]);
             }
         } catch (\Exception $e) {
             // En cas d'erreur, retournez une réponse d'erreur
             return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
         }
     }
     
 
     public function delete($id){
        $Actualite = Actualite::find($id);
       
        if (!$Actualite) {
           return response()->json(
               [ 'status'=>404,
               'message' => 'Actualite non trouvé'
           ], 404);
       }
       else {
           $Actualite->delete();
           return response()->json([
           'message' => 'Actualite supprimé avec succès'],
            200);
       }
    }
    public function getById($id){
        $Actualite = Actualite::find($id);
   
        if (!$Actualite) {
           return response()->json(
               [ 'status'=>404,
               'message' => 'Actualite non trouvé'
           ], 404);
    }
    
}

}