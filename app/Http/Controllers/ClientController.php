<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Rules\ValidRut;
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
        // Validar según los nombres que viene en Postman (español)
        $validated = $request->validate([
            'rut' => ['required', 'string', 'max:255', 'unique:clients,dni', new ValidRut()],
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:clients,email'],
            'telefono' => ['nullable', 'string', 'max:255', 'unique:clients,phone_number'],
        ]);

        // Mapear de español a inglés para guardar en BD
        $data = [
            'first_name' => $validated['nombre'],
            'last_name' => $validated['apellido'],
            'dni' => $validated['rut'],
            'email' => $validated['email'],
            'phone_number' => $validated['telefono'] ?? null,
        ];

        $client = Client::create($data);

        return response()->json([
            'message' => 'Cliente creado correctamente',
            'data' => $client,
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $client = Client::find($id);

        if (! $client) {
            return response()->json([
                'message' => 'Cliente no encontrado',
            ], 404);
        }

        return response()->json($client, 200);
    }
}



