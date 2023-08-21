<?php

namespace App\Http\Controllers\api;

use App\Models\document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class documentController extends Controller
{
     public function ajouter(Request $request) {
        $imagesName = [];
        $response = [];
 
        $validator = Validator::make($request->all(),
            [
                'nom_document' => 'required',
                'pièce_jointe' => 'required',
                'pièce_jointe' => 'required|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
                'enfant_id' => 'required',

            ]
        );
 
        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "Validation error", "errors" => $validator->errors()]);
        }
 
        if($request->has('pièce_jointe')) {
            $img=$request->pièce_jointe;
            $filename = Str::random(32).".".$img->getClientOriginalExtension();

             $nom_document = $request->input('nom_document');
            $enfant_id = $request->input('enfant_id');
          
                $img->move('uploads/', $filename);
 
               
            
  document::create([
                    'nom_document'=> $nom_document,
                    'pièce_jointe'=> $filename,
                    'enfant_id'   => $enfant_id

                    
                ]);
            $response["status"] = "successs";
            $response["message"] = "Success! image(s) uploaded";
        }
 
        else {
            $response["status"] = "failed";
            $response["message"] = "Failed! image(s) not uploaded";
        }
        return response()->json($response);
    }
    public function index()  {
        $documents= document::all();
        if($documents->count()>0)
         return response()->json([
             'status'=>200,
             'documents'=>$documents
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'documents'=>' aucun documents'
            ],404);
     
     
       
     }
    public function documentforenfant($idenf)  {
        $documents= document::where('enfant_id',$idenf)->get();
        if($documents->count()>0)
         return response()->json([
             'status'=>200,
             'documents'=>$documents
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'documents'=>' aucun documents for enfant'
            ],404);
     
     
       
     }

     public function update(documentStoreRequest $request, $id)
     {
         try {
             // Find document
             $document = document::find($id);
             if(!$document){
               return response()->json([
                 'message'=>'document Not Found.'
               ],404);
             }
      
             $document->nom = $request->nom;
             $document->description = $request->description;
      
             if($request->image) {
                 // Public storage
                 $storage = Storage::disk('public/upload');
      
                 // Old iamge delete
                 if($storage->exists($document->image))
                     $storage->delete($document->image);
      
                 // Image name
                 $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
                 $document->image = $imageName;
      
                 // Image save in public folder
                 $storage->put($imageName, file_get_contents($request->image));
             }
      
             // Update document
             $document->save();
      
             // Return Json Response
             return response()->json([
                 'message' => "document successfully updated."
             ],200);
         } catch (\Exception $e) {
             // Return Json Response
             return response()->json([
                 'message' => "Something went really wrong!"
             ],500);
         }
     }
    }
