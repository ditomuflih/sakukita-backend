<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // Display a listing of the user's transactions
    public function index()
    {
        $transactions = Auth::user()->transactions;
        return response()->json($transactions);
    }

    // Store a newly created transaction in the database
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $transaction = new Transaction([
            'amount' => $request->amount,
            'date' => $request->date,
            'category' => $request->category,
            'type' => $request->type,
            'user_id' => Auth::id(),
        ]);

        $transaction->save();

        return response()->json([
            'message' => 'Transaction successfully added!',
            'transaction' => $transaction
        ], 201);
    }
}
