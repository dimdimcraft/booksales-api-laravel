<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index() 
    {
        $book = Book::all();
        if ($book->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Resource Not Found'
            ], 200);
        }
        return response()->json([
            'success' => true,
            'message' => 'Get All Resources',
            'data' => $book
        ], 200);
    }

    public function store(Request $request){
        // validator
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stok' => 'required|integer',
            'cover_photo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
        ]);

        // cek validator
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }
        // upload image
        $image = $request->file('cover_photo');
        $image->store('books', 'public');

        // insert data
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stok' => $request->stok,
            'cover_photo' => $image->hashName(),
            'genre_id' => $request->input('genre_id'),
            'author_id' => $request->input('author_id')
        ]);

        // response
        return response()->json([
            'success' => true,
            'message' => 'Resource Created',
            'data' => $book
        ], 201);
    }
}