<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageStoreRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use DB;
use Storage;
use Symfony\Component\HttpFoundation\Response;


class ImageController extends Controller
{
    public function imageStore(ImageStoreRequest $request)
    {
        $worker = DB::table('workers')
                            ->select('workers.id', 'workers.name_kh', 'workers.name_en')
                            ->where('workers.active', 1)
                            ->where('workers.id', $request->worker_id)
                            ->first();

        if($worker == null) {
            return response()->json([
                'success' => false,
                'message' => "This worker information is not found.",
            ], 404);
        }

        $user = auth()->user();
        $validatedData = $request->validated();
        $validatedData['image'] = $request->file('image')->store('image', 'public');
        $worker_doc_id = 0;

        $count = DB::table('worker_documents')->where('worker_documents.type', 'image')->count();
        if($count == 0) {

            DB::table('workers')
                    ->where('workers.id', $request->worker_id)
                    ->update([
                        "photo" => $validatedData['image']
                    ]);
        }

        if($request->has('worker_doc_id') && $request->worker_doc_id != 0) {

            $worker_doc_id = $request->worker_doc_id;
            DB::table('worker_documents')
                    ->where('worker_documents.id', $request->worker_doc_id)
                    ->where('worker_documents.active', 1)
                    ->update([
                        "name" => $validatedData['image'],
                        "updated_by" => $user->id,
                        "updated_at" => now(),
                    ]);
                    
        } else {
            $worker_doc_id = DB::table('worker_documents')->insertGetId(
                [
                    "worker_id" => $request->worker_id,
                    "name" => $validatedData['image'],
                    "type" => "image",
                    "path" => "",
                    "active" => 1,
                    "created_by" => $user->id,
                    "created_at" => now(),
                    "updated_by" => $user->id,
                    "updated_at" => now(),

                ]
            );
        }

        $response = [
            'success' => true,
            'data'    =>[
                'worker_id' => $request->worker_id,
                'worker_doc_id' => $worker_doc_id,
                'image' => $validatedData['image']
            ],
            'message' => "Image has uploaded successfully.",
        ];


        return response()->json($response, 200);
    }

    public function imageDrop(Request $request)
    {
        $worker_document = DB::table('worker_documents')
                            ->where('worker_documents.active', 1)
                            ->where('worker_documents.id', $request->worker_doc_id)
                            ->first();

        if($worker_document == null) {
            return response()->json([
                'success' => false,
                'message' => "Image of worker is not found.",
            ], 404);
        }

        if(Storage::exists($worker_document->name)){
            Storage::delete($worker_document->name);
        }
            
        if($request->has('worker_doc_id') && $request->worker_doc_id != 0) {

            DB::table('worker_documents')
                    ->where('worker_documents.id', $request->worker_doc_id)
                    ->delete();
        }

        $response = [
            'success' => true,
            'data'    =>[
                'worker_id' => $worker_document->worker_id,
                'worker_doc_id' => $request->worker_doc_id,
                'image' => $worker_document->name
            ],
            'message' => "Image has been deleted successfully.",
        ];

        return response()->json($response, 200);        
    }

    public function show(Request $request, $filename)
    {
        $folder_name = 'public/storage/image';

        $filename = 'YfDzrbJfGXxMBAD052aPFcpFQlQwCJU32CwFiuU0.png';

        $path = $folder_name.'/'.$filename;

        die($path);

        if(!Storage::exists($path)){
            abort(404);
        }

        return Storage::response($path);
    }
}