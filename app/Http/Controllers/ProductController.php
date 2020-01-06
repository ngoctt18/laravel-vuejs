<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Product::get();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'price' => 'required',
        ]);
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
        ]);
        return response([
            'product' => $product
        ], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'price' => 'required',
        ]);

        $product = Product::find($id);

        $product->name = $request->input('name');
        $product->price = $request->input('price');

        $product->save();

        return response([
            'product' => $product
        ], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response([
            'result' => 'success'
        ], 200);
    }
}
