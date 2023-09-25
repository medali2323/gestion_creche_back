<?php

namespace App\Http\Controllers\api;

use App\Models\document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
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
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'nom_document'=>'required|max:250',
            'enfant_id'=>'required',
            'pièce_jointe'=>'required|image|mimes:jpg,bmp,png,pdf'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'=>'Validation errors',
                'errors'=>$validator->messages()
            ],422);
        }

        $image_name=time().'.'.$request->pièce_jointe->extension();
        $request->pièce_jointe->move(public_path('/uploads/document_images'),$image_name);

        $document=document::create([
            'nom_document'=>$request->nom_document,
            'enfant_id'=>$request->enfant_id,
            'pièce_jointe'=>$image_name
        ]);

        
        return response()->json([
            'message'=>'document successfully created',
            'data'=>$document
        ],200);

    }
    public function updatedocument($id,Request $request){
        $document=document::findOrFail($id);
        if($document){
            
                $validator = Validator::make($request->all(), [
                    'nom_document'=>'required|max:250',
                    'enfant_id'=>'required',
                    'pièce_jointe'=>'required|image|mimes:jpg,bmp,png,pdf'
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'message'=>'Validation errors',
                        'errors'=>$validator->messages()
                    ],422);
                }

                if($request->hasFile('pièce_jointe')){
                    $image_name=time().'.'.$request->pièce_jointe->extension();
                    $request->pièce_jointe->move(public_path('/uploads/document_images'),$image_name);
                    $old_path=public_path().'/uploads/document_images/'.$document->pièce_jointe;
                    if(File::exists($old_path)){
                        File::delete($old_path);
                    }
                }else{
                    $image_name=$document->pièce_jointe;
                }

                $document->update([
                    'nom_document'=>$request->nom_document,
                    'enfant_id'=>$request->enfant_id,
                    'pièce_jointe'=>$image_name
                ]);

                
                return response()->json([
                    'message'=>'document successfully updated',
                    'data'=>$document
                ],200);


            
        }else{
            return response()->json([
                'message'=>'No document found',
            ],400);   
        }
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

     public function update(Request $request,$id)
     {
         $document=document::findOrFail($id);
         
         $destination=public_path("uploads/".$document->pièce_jointe);
         $filename="";
         if($request->hasFile('pièce_jointe')){
             if(File::exists($destination)){
                 File::delete($destination);
             }
 
             $filename=$request->file('pièce_jointe')->store('posts','public');
         }else{
             $filename=$request->image;
         }
         $document->nom_document=$request->nom_document;
         $document->enfant_id=$request->enfant_id;
         $document->pièce_jointe=$filename;
         $result=$document->save();
         if($result){
             return response()->json(['success'=>true]);
         }else{
             return response()->json(['success'=>false]);
         }
     }
 
 
     public function delete($id){
        $document = document::find($id);
       
        if (!$document) {
           return response()->json(
               [ 'status'=>404,
               'message' => 'document non trouvé'
           ], 404);
       }
       else {
           $document->delete();
           return response()->json([
           'message' => 'document supprimé avec succès'],
            200);
       }
    }
    public function getById($id){
        $document = document::find($id);
   
        if (!$document) {
           return response()->json(
               [ 'status'=>404,
               'message' => 'document non trouvé'
           ], 404);
    }
}
}