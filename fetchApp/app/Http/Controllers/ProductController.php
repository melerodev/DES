<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    function main() {
        return view('main');
    }
    
    function fetch() {
        return view('fetch');
    }

    function modal() {
        return view('modal');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['product' => Product::orderBy('name')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
    */

    public function store(Request $request) {
        $result = [];
        $validated = Validator::make($request->all(), [
            'name'  => 'required|unique:product|max:100|min:2',
            'price' => 'required|numeric|gte:0|lte:100000',
        ]);

        $object = new Product($request->all());

        if ($validated->fails()) {
            $result = ['result' => false, 'errors' => $validated->getMessageBag()];
        }

        try {
            $result = $object->save();
        } catch (\Exception $e) {
            $result = ['result' => false, 'errors' => $e->getMessage()];
        }
        return response()->json(['result' => $result]);
    } 
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
        $message = '';
        
        if ($product === null) {
            $message = 'Product not found';
        }

        return response()->json(['message'  => $message, 'product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $result = [];

        if ($product != null) {
            $validated = Validator::make($request->all(), [
                'name'  => 'required|max:100|min:2|unique:product,name,' . $product->id,
                'price' => 'required|numeric|gte:0|lte:100000',
            ]);

            if ($validated->passes()) {
                try {
                    $product->update($request->all());
                    $result = ['result' => true];
                } catch (\Exception $e) {
                    $result = ['result' => false, 'errors' => $e->getMessage()];
                }
            } else {
                $result = ['result' => false, 'errors' => $validated->getMessageBag()];
            }
        } else {
            $result = ['result' => false, 'errors' => 'Product not found'];
        }

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = Product::find($product->id);
        $result = [];

        if ($product != null) {;
            try {
                $product->delete();
                $result = ['result' => true];
            } catch (\Exception $e) {
                $result = ['result' => false, 'errors' => $e->getMessage()];
            }
        } else {
            $result = ['result' => false, 'errors' => 'Product not found'];
        }
        return response()->json($result);
    }
}
