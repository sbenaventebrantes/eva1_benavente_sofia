<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class HealthController extends Controller
{
    public function check(): JsonResponse
    {
        return response()->json([
            'status' => 'online',
            'version' => '1.0.0',
            'environment' => 'docker',
        ], 200);
    }
}
