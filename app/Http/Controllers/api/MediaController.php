<?php

namespace App\Http\Controllers\api;

use App\Models\media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    //
    public function ajouter(Request $request) {
        $filessName = [];
        $response = [];
 
        $validator = Validator::make($request->all(),
            [
                'nom' => 'required',
                'pièce_jointe' => 'required',
                'pièce_jointe' => 'required|mimes:jpeg,png,jpg,gif,svg,mp4,wav|max:20480',
                'enfant_id' => 'required',

            ]
        );
 
        if($validator->fails()) {
            return response()->json(["status" => "failed", "message" => "Validation error", "errors" => $validator->errors()]);
        }
 
        if($request->has('pièce_jointe')) {
            $img=$request->pièce_jointe;
            $filename = Str::random(32).".".$img->getClientOriginalExtension();

             $nom = $request->input('nom');
            $enfant_id = $request->input('enfant_id');
          
            $img->move('uploads/', $filename);
      
  media::create([
                    'nom'=> $nom,
                    'pièce_jointe'=> $filename,
                    'enfant_id'   => $enfant_id    ]);
            $response["status"] = "successs";
            $response["message"] = "Success! files(s) uploaded";
        }
 
        else {
            $response["status"] = "failed";
            $response["message"] = "Failed! files(s) not uploaded";
        }
        return response()->json($response);
    }
    public function update(mediaStoreRequest $request, $id)
    {
        try {
            // Find media
            $media = media::find($id);
            if(!$media){
              return response()->json([
                'message'=>'media Not Found.'
              ],404);
            }
     
            $media->nom = $request->nom;
            $media->description = $request->description;
     
            if($request->image) {
                // Public storage
                $storage = Storage::disk('public/upload');
     
                // Old iamge delete
                if($storage->exists($media->image))
                    $storage->delete($media->image);
     
                // Image name
                $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
                $media->image = $imageName;
     
                // Image save in public folder
                $storage->put($imageName, file_get_contents($request->image));
            }
     
            // Update media
            $media->save();
     
            // Return Json Response
            return response()->json([
                'message' => "media successfully updated."
            ],200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ],500);
        }
    }
    public function index()  {
        $enfants= media::all();
        if($medias->count()>0)
         return response()->json([
             'status'=>200,
             'medias'=>$medias
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'medias'=>' aucun medias'
            ],404);
     
     
       
     }
     public function mediaforenfant($idenf)  {
        $medias= media::where('enfant_id',$idenf)->get();
        if($medias->count()>0)
         return response()->json([
             'status'=>200,
             'medias'=>$medias
            ],200);
        
        else 
         return response()->json([
             'status'=>404,
             'medias'=>' aucun medias for enfant'
            ],404);
     
     
       
     }
     public function delete($id)
     {
      $media = media::find($id);
     
      if (!$media) {
         return response()->json(
             [ 'status'=>404,
             'message' => 'media non trouvé'
         ], 404);
     }
     else {
         $media->delete();
         return response()->json([
         'message' => 'media supprimé avec succès'],
          200);
     }
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'nom'=>'required|max:250',
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
        $request->pièce_jointe->move(public_path('/uploads/media_images'),$image_name);

        $media=media::create([
            'nom'=>$request->nom,
            'enfant_id'=>$request->enfant_id,
            'pièce_jointe'=>$image_name
        ]);

        
        return response()->json([
            'message'=>'media successfully created',
            'data'=>$media
        ],200);

    }
    public function updatemedia($id,Request $request){
        $media=media::findOrFail($id);
        if($media){
            
                $validator = Validator::make($request->all(), [
                    'nom'=>'required|max:250',
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
                    $request->pièce_jointe->move(public_path('/uploads/media_images'),$image_name);
                    $old_path=public_path().'/uploads/media_images/'.$media->pièce_jointe;
                    if(File::exists($old_path)){
                        File::delete($old_path);
                    }
                }else{
                    $image_name=$media->pièce_jointe;
                }

                $media->update([
                    'nom'=>$request->nom,
                    'enfant_id'=>$request->enfant_id,
                    'pièce_jointe'=>$image_name
                ]);

                
                return response()->json([
                    'message'=>'media successfully updated',
                    'data'=>$media
                ],200);


            
        }else{
            return response()->json([
                'message'=>'No media found',
            ],400);   
        }
    }
}
