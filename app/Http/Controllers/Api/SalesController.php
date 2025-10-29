<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionItems;
use Illuminate\Support\Facades\DB;
class SalesController extends Controller
{

    public function index()
    {
        $transactions = Transaction::with(['items.product'])->get();
        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $transaction = Transaction::create([
                'cashier_name' => $request->cashier_name,
                'payment_method' => $request->payment_method,
                'subtotal' => $request->subtotal,
                'tax' => $request->tax,
                'total' => $request->total,
                'timestamp' => now(),
            ]);

            foreach ($request->items as $item) {
                $transaction->items()->create([
                    'product_id' => $item['productId'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'cost' => $item['cost'] ?? 0,
                    'qty' => $item['qty'],
                    'subtotal' => $item['price'] * $item['qty'],
                ]);
            }
        });

        return response()->json(['message' => 'Transaction saved successfully']);
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }
}
