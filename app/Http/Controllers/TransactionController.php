<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $Transaction = Transaction::with('user','book')->get();

        if ($Transaction->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No transactions found',
                'data' => $Transaction
            ], 404);
        }

        return response()->json([
                'success' => false,
                'message' => 'Get All Transactions',
                'data' => $Transaction
            ], 200);
    }

    public function store(Request $request)
   {
     // validator & cek validator
    $validator = Validator::make(request()->all(), [
        'book_id' => 'required|exists:books,id',
        'quantity' => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => $validator->errors()
        ], 422);
    }

    // generate order_number
    $uniqueCode = 'ORD-' . strtoupper(uniqid());

    // ambil data user login
    $user = auth('api')->user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'unauthorized',
        ], 401);
    }

    // mencari data buku dari request
    $book = Book::find($request->book_id);

    // cek stok buku
    if ($book->stok<$request->quantity) {
        return response()->json([
            'success' => false,
            'message' => 'Stok buku tidak cukup',
        ], 400);
    }

    // hitung total harga
    $totalAmount = $book->price * $request->quantity;

    // kurangi stok buku
    $book->stok -= $request->quantity;
    $book->save();

    // simpan data transaksi
    $transaction = Transaction::create([
        'order_number' => $uniqueCode,
        'customer_id' => $user->id,
        'book_id' => $book->id,
        'total_amount' => $totalAmount,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Transaction created successfully',
        'data' => $transaction
    ], 201);

   }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'book_id' => 'sometimes|exists:books,id',
            'quantity' => 'sometimes|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'data' => $validator->errors()
            ], 422);
        }

        if ($request->has('book_id')) {
            $transaction->book_id = $request->book_id;
        }
        if ($request->has('quantity')) {
            $transaction->quantity = $request->quantity;
        }
        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully',
            'data' => $transaction
        ], 200);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ], 200);
    }
}
