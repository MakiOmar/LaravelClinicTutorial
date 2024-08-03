<?php

namespace App\Http\Controllers\API\Tag;

use App\Http\Controllers\API\RespController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;

class TagApiController extends Controller
{
    use RespController;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::get();
        return $this->successResponse($tags, 'Success', 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            array(
                'content' => 'required|string|unique:tags,content|max:255',
            )
        );
        // Perform the validation
        if ($validator->fails()) {
            // Validation fails
            return $this->errorResponse('In correct data!', 422, $validator->errors());
        }

        $tag = Tag::create(
            array(
                'content' => $request['content'],
            )
        );
        return $this->successResponse($tag, 'Tag has been added successflly', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if ($tag->delete()) {
            return $this->successResponse('Success', 'Tag has been deleted successflly', 200);
        } else {
            return $this->errorResponse('error', 422, 'Failed to delete the tag.');
        }
    }
}
