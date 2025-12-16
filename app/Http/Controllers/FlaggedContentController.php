<?php

namespace App\Http\Controllers;

use App\Models\FlaggedContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlaggedContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FlaggedContent::with('user', 'content')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content_id' => 'required|integer',
            'content_type' => 'required|string|in:resource,resource_review',
            'reason' => 'required|string|max:255',
        ]);

        return FlaggedContent::create([
            'content_id' => $validated['content_id'],
            'content_type' => $validated['content_type'] === 'resource' ? 'App\Models\Resource' : 'App\Models\ResourceReview',
            'user_id' => $request->user()->id,
            'reason' => $validated['reason'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FlaggedContent $flaggedContent)
    {
        $flaggedContent->delete();

        return response()->noContent();
    }

    /**
     * Approve the specified resource.
     */
    public function approve(FlaggedContent $flaggedContent)
    {
        $flaggedContent->delete();

        return response()->noContent();
    }

    /**
     * Reject the specified resource.
     */
    public function reject(FlaggedContent $flaggedContent)
    {
        DB::transaction(function () use ($flaggedContent) {
            $flaggedContent->content->delete();
            $flaggedContent->delete();
        });

        return response()->noContent();
    }
}
