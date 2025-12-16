<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Resource::with('courseHub', 'user', 'reviews')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_hub_id' => 'required|exists:course_hubs,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $path = $request->file('file')->store('resources');

        $resource = null;
        DB::transaction(function () use ($validated, $path, &$resource, $request) {
            $resource = Resource::create([
                'course_hub_id' => $validated['course_hub_id'],
                'user_id' => $request->user()->id,
                'title' => $validated['title'],
                'description' => $validated['description'],
                'file_path' => $path,
            ]);

            $request->user()->pointLedgers()->create([
                'points' => 10,
                'reason' => 'Uploaded a resource',
            ]);
        });

        return $resource;
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        return $resource->load('courseHub', 'user', 'reviews');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        $this->authorize('delete', $resource);

        $resource->delete();

        return response()->noContent();
    }
}
