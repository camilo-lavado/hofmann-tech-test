<?php

namespace App\Http\Controllers;

use App\Services\HofmannApiService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(HofmannApiService $hofmann)
    {
        $users = $hofmann->getTableUsers();
        $codes = $hofmann->getCodes();

        return view('users', compact('users', 'codes'));
    }

    public function send(Request $request, HofmannApiService $hofmann)
    {
        $data = $request->only(['id', 'code', 'amount', 'date']);
        $data['github'] = 'https://github.com/camilo-lavado';

        $status = $hofmann->sendUser($data);

        return response()->json(['status' => $status]);
    }
}
