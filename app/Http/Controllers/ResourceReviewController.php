<?php

namespace App\Http\Controllers;

use App\Models\ResourceReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourceReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'resource_id' => 'required|exists:resources,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $review = null;
        DB::transaction(function () use ($validated, &$review, $request) {
            $review = ResourceReview::create([
                'resource_id' => $validated['resource_id'],
                'user_id' => $request->user()->id,
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]);

            if ($validated['rating'] >= 4) {
                $review->resource->user->pointLedgers()->create([
                    'points' => 2,
                    'reason' => 'Positive review on a resource',
                ]);
            }
        });

        return $review;
    }
}
