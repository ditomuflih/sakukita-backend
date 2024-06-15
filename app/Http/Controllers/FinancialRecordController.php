<?php

namespace App\Http\Controllers;

use App\Models\FinancialRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialRecordController extends Controller
{
    public function index()
    {
        $records = FinancialRecord::where('user_id', Auth::id())->get();
        return response()->json($records);
    }

    public function store(Request $request)
    {
        $record = FinancialRecord::create([
            'user_id' => Auth::id(),
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);
        return response()->json($record);
    }

    public function show($id)
    {
        $record = FinancialRecord::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($record);
    }

    public function update(Request $request, $id)
    {
        $record = FinancialRecord::where('user_id', Auth::id())->findOrFail($id);
        $record->update($request->all());
        return response()->json($record);
    }

    public function destroy($id)
    {
        $record = FinancialRecord::where('user_id', Auth::id())->findOrFail($id);
        $record->delete();
        return response()->json('Record deleted successfully');
    }
}
