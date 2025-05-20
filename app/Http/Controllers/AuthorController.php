<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    public function index()
    {
        $author = Author::all();
        if ($author->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Resource Not Found'
            ], 200);
        }
        return response()->json([
            'success' => true,
            'message' => 'Get All Authors',
            'data' => $author
        ], 200);
    }

    public function store(Request $request){
        // validator
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255'
        ]);

        // cek validator
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // insert data
        $author = Author::create([
            'name' => $request->name
        ]);

        // response
        return response()->json([
            'success' => true,
            'message' => 'Resource Created',
            'data' => $author
        ], 201);
    }
}
