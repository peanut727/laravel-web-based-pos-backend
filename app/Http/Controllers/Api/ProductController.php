<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    
    // GET
    public function index()
    {
        return response()->json([Product::all()]);
    }

    // POST
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    // GET::ID
    public function show(string $id)
    {
        return response()->json([Product::findOrFail($id)]);
    }

    // PUT
    public function update(Request $request, string $id)
    {
        
    }

    // DELETE
    public function destroy(string $id)
    {
        Product::destroy($id);
        return response()->json(null, 204);
    }
}
