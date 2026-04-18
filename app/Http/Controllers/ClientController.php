<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(): JsonResponse
    {
        $clients = Client::all();

        return response()->json($clients, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|unique:clients,email',
            'phone_number' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
        ]);

        $client = Client::create($validated);

        return response()->json($client, 201);
    }
}
