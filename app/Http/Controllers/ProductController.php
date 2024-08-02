<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Models\Tag as ProductTags;
use App\Models\ProductTage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method one
        $user = Auth()->user();
        $products = $user->products;

        // Method two
        // $products = Product::where( 'user_id', Auth()->id() )->get();

        return view('products.index', compact('user', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth()->user();
        $tags = ProductTags::all();
        return view('products.create', compact('user', 'tags'));
    }

    /**
     * Get user products
     */
    public function users(User $user)
    {
        return $user;
    }
    protected function validation($request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'rate' => 'required|integer|min:1|max:5',
            'tag_id' => 'sometimes|nullable|array',
            'tag_id.*' => 'integer',
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validation($request);
        $product = Product::create(
            [
                'user_id' => Auth()->id(),
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'rate' => $validated['rate'],
            ]
        );
        foreach ($validated['tag_id'] as $tag_id) {
            ProductTage::create(
                [
                    'product_id' => $product->id,
                    'tag_id'     => $tag_id,
                ]
            );
        }
        return redirect()->route('product.edit', ['product' => $product->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $user = Auth()->user();
        return view('products.show', compact('user', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $user = Auth()->user();
        $tags = ProductTags::all();
        return view('products.edit', compact('product', 'user', 'tags'));
    }
    public function hasTag($product_id, $tag_id)
    {
        return ProductTage::where('product_id', $product_id)->where('tag_id', $tag_id)->first();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $this->validation($request);

        $product->title = $validated['title'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->rate = $validated['rate'];
        $product->save();
        // Find the existing ProductTag record.
        $productTags = $product->tags->pluck('id')->toArray();
        // Update the existing record or create a new one.
        if ($productTags) {
            foreach ($productTags as $tag_id) {
                if (! in_array($tag_id, $validated['tag_id'])) {
                    $product->tags()->detach($tag_id);
                }
            }
        }
        foreach ($validated['tag_id'] as $tag_id) {
            if (! $this->hasTag($product->id, $tag_id)) {
                ProductTage::create(
                    [
                        'product_id' => $product->id,
                        'tag_id'     => $tag_id,
                    ]
                );
            }
        }
        return redirect()->back()->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return redirect()->route('product')->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->route('product')->with('error', 'Failed to delete the product.');
        }
    }
}
