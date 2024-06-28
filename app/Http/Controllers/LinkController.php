<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Http\JsonResponse;

class LinkController extends Controller
{
    /**
     * Get a specific link by smig_path
     */
    public function show(Request $request, $smig_path): JsonResponse
    {
        $link = Link::where('smig_path', $smig_path)->first();
        if ($link) {
            return response()->json($link);
        }
        return response()->json(['error' => 'Link not found'], 404);
    }

    /**
     * Create a new link
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'long_path' => 'required|string',
            'smig_path' => 'required|string|unique:links',
        ]);

        $link = Link::create($validatedData);

        return response()->json($link, 201);
    }

    /**
     * Update an existing link
     */
    public function update(Request $request, $smig_path): JsonResponse
    {
        $validatedData = $request->validate([
            'long_path' => 'sometimes|required|string',
            'smig_path' => 'sometimes|required|string|unique:links,smig_path,' . $smig_path . ',smig_path',
        ]);

        $link = Link::where('smig_path', $smig_path)->first();
        if ($link) {
            $link->update($validatedData);
            return response()->json($link);
        }
        return response()->json(['error' => 'Link not found'], 404);
    }

    /**
     * Delete a link
     */
    public function destroy(Request $request, $smig_path): JsonResponse
    {
        $link = Link::where('smig_path', $smig_path)->first();
        if ($link) {
            $link->delete();
            return response()->json(['message' => 'Link deleted successfully']);
        }
        return response()->json(['error' => 'Link not found'], 404);
    }
}
