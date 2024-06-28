<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

abstract class Controller extends BaseController
{
    /**
     * Get the profile
     */
    public function show(Request $request): JsonResponse
    {
        $user = User::where('name', $request->name)->first();
        if ($user) {
            return response()->json($user);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

    /**
     * Create the profile
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json($user, 201);
    }

    /**
     * Update the profile
     */
    public function update(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $request->user()->id,
            'password' => 'sometimes|required|string|min:8',
        ]);

        $user = User::where('name', $request->name)->first();
        if ($user) {
            if (isset($validatedData['name'])) {
                $user->name = $validatedData['name'];
            }
            if (isset($validatedData['email'])) {
                $user->email = $validatedData['email'];
            }
            if (isset($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }
            $user->save();

            return response()->json($user);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

    /**
     * Delete a profile
     */
    public function destroy(Request $request): JsonResponse
    {
        $user = User::where('name', $request->name)->where('email', $request->email)->first();
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        }
        return response()->json(['error' => 'User not found'], 404);
    }
}
