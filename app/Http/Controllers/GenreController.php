<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
public function index()
    {
        $genre = Genre::all();
        if ($genre->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Resource Not Found'
            ], 200);
        }
        return response()->json([
            'success' => true,
            'message' => 'GeT All Resources',
            'data' => $genre
        ], 200);
    }

    public function store(Request $request){
        // validator
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        // cek validator
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // insert data
        $genre = Genre::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        // response
        return response()->json([
            'success' => true,
            'message' => 'Resource Created',
            'data' => $genre
        ], 201);
    }

    public function show($id)
    {
        $genre = Genre::find($id);
        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Resource Not Found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Get Resource',
            'data' => $genre
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        // cari data
        $genre = Genre::find($id);
        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Resource Not Found'
            ], 404);
        }

        // cek validasi
        $validator = Validator::make($request->all(),[
            'name' => 'string|max:255',
            'description' => 'string'
        ]);

        // cek validator
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // update data
        $genre->update($request->all());

        // response
        return response()->json([
            'success' => true,
            'message' => 'Resource Updated',
            'data' => $genre
        ], 200);
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);
        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Resource Not Found'
            ], 404);
        }
        $genre->delete();
        return response()->json([
            'success' => true,
            'message' => 'Resource Deleted'
        ], 200);
    }
}
