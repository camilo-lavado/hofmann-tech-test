<?php

namespace App\Http\Controllers;

use App\Services\HofmannApiService;
use App\Http\Requests\SendUserRequest;

class UserController extends Controller
{
    public function index(HofmannApiService $hofmann)
    {
        $users = $hofmann->getTableUsers();
        $codes = $hofmann->getCodes();
        return view('users', compact('users', 'codes'));
    }

    public function send(SendUserRequest $request, HofmannApiService $hofmann)
    {
        $validated = $request->validated();
        $validated['github'] = 'https://github.com/camilo-lavado';

        try {
            $status = $hofmann->sendUser($validated);
            if ($status === 200) {
                return response()->json(['status' => 200]);
            }
            return response()->json([
                'status' => $status,
                'message' => 'Error desde la API externa.'
            ], 500);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error de conexión con la API externa.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
