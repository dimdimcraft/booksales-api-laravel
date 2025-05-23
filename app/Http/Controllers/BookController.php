<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

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

    public function show(string $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Resource Not Found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Get detail Resource',
            'data' => $book
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        // cari data
        $book = Book::find($id);   
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Resource Not Found'
            ], 404);
        }

        // cek validasi
        $validator = Validator::make($request->all(),[
            'title' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric',
            'stok' => 'integer',
            'cover_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'genre_id' => 'exists:genres,id',
            'author_id' => 'exists:authors,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        // data yang akan diupdate
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'stok' => $request->stok,
            'genre_id' => $request->genre_id,
            'author_id' => $request->author_id
        ];

        // handle photo
        if ($request->hasFile('cover_photo')) {
            // update data baru
            $image = $request->file('cover_photo');
            $image->store('books', 'public');

            // hapus data lama
            if ($book->cover_photo) {
                Storage::disk('public')->delete('books/' . $book->cover_photo);
            }

            // memasukkan data baru ke data
            $data['cover_photo'] = $image->hashName();
        }

        // update data
        $book->update($data);
        return response()->json([
            'success' => true,
            'message' => 'Resource Updated',
            'data' => $book
        ], 200);
    }


    publiC function destroy(string $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Resource Not Found'
            ], 404);
        }

        // menghapus file gambar
        if ($book->cover_photo) {
            Storage::disk('public')->delete('books/' . $book->cover_photo);
        }

        $book->delete();
        return response()->json([
            'success' => true,
            'message' => 'Resource Deleted'
        ], 200);
    }
}