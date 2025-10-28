<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\BarcodeHelper;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    
    // GET
    public function index()
    {
        return response()->json(Product::all());
    }

    // POST
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:products,name',
            'category' => 'required|string',
            'price'=> 'required|numeric',
            'stock' => 'required|numeric',
            'barcode'=> 'nullable|string|unique:products,barcode',
        ]);

        if (empty($validated['barcode'])) {
            $validated['barcode'] = BarcodeHelper::generateBarcode();
        }

        $product = Product::create($validated);
         return response()->json([
            'message' => 'Product created successfully!',
            'data' => $product
         ],  201);
    }

    // GET::ID
    public function show(string $id)
    {
        return response()->json(Product::findOrFail($id));
    }

    // PUT
    public function update(Request $request, string $id)
    {
        $product = Product::findorFail($id);
        $product->update($request->all());
        return response()->json($product, 204);
    }

    // DELETE
    public function destroy(string $id)
    {
        Product::destroy($id);
        return response()->json(null, 204);
    }
}
