<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Auth;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth()->user();
        $tags = Tag::get();
        return view('tags.index', compact('user', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth()->user();
        return view('tags.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        Tag::create(
            [
                'content' => $validated['content'],
            ]
        );
        return redirect()->back()->with('success', 'Tag has been added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if ($tag->delete()) {
            return redirect()->route('tags')->with('success', 'Tag has been deleted successfully.');
        } else {
            return redirect()->route('tags')->with('error', 'Failed to delete the tag.');
        }
    }
}
