<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\API\RespController;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductTage;

class ProductApiController extends Controller
{
    use RespController;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Method one
        $user     = Auth()->user();
        $products = $user->products;

        return $this->successResponse($products, 'Success', 200);
    }
    protected function validation($request)
    {
        $validator = Validator::make(
            $request->all(),
            array(
                'title'       => 'required|string|max:255',
                'description' => 'required|string',
                'price'       => 'required|numeric|min:0',
                'rate'        => 'required|integer|min:1|max:5',
                'tag_id'      => 'sometimes|nullable|string',
            )
        );
        return $validator;
    }

        /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);
        // Perform the validation
        if ($validator->fails()) {
            // Validation fails
            return $this->errorResponse('In correct data!', 422, $validator->errors());
        }
        $product   = Product::create(
            array(
                'user_id'     => Auth()->id(),
                'title'       => $request['title'],
                'description' => $request['description'],
                'price'       => $request['price'],
                'rate'        => $request['rate'],
            )
        );
        if (! empty($request['tag_id'])) {
            $TagsIds = explode(',', $request['tag_id']);
            foreach ($TagsIds as $tag_id) {
                ProductTage::create(
                    array(
                        'product_id' => $product->id,
                        'tag_id'     => $tag_id,
                    )
                );
            }
        }
        return $this->successResponse($product, 'Success', 200);
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
        $validator = $this->validation($request);
        // Perform the validation
        if ($validator->fails()) {
            // Validation fails
            return $this->errorResponse('In correct data!', 422, $validator->errors());
        }
        if ($product->user_id != Auth()->id()) {
            return $this->errorResponse('Unauthorized', 403, 'Forbidden');
        }
        $product->title       = $request['title'];
        $product->description = $request['description'];
        $product->price       = $request['price'];
        $product->rate        = $request['rate'];

        // Find the existing ProductTag record.
        $productTags = $product->tags->pluck('id')->toArray();
        // Update the existing record or create a new one.
        if (! empty($request['tag_id'])) {
            $TagsIds = explode(',', $request['tag_id']);
            if ($productTags) {
                foreach ($productTags as $tag_id) {
                    if (! in_array($tag_id, $TagsIds)) {
                        $product->tags()->detach($tag_id);
                    }
                }
            }

            foreach ($TagsIds as $tag_id) {
                if (! $this->hasTag($product->id, $tag_id)) {
                    ProductTage::create(
                        array(
                            'product_id' => $product->id,
                            'tag_id'     => $tag_id,
                        )
                    );
                }
            }
        }
        $product->save();
        return $this->successResponse('Product has been updated', 'Success', 200);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return $this->successResponse('Product has deleted successfully.', 'Success', 200);
        } else {
            return $this->errorResponse('Failed to delete the product.', 422, 'Error');
        }
    }
}
