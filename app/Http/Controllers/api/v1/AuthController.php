<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\api\BaseController as BaseController;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends BaseController
{

    public function login(Request $request)
    {
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($credential)) {
            $user = Auth::user();
            return response()->json($user, 200);
        }
        
        return $this->sendError('Sorry!!! User name or password mismatch');
    }

    public function getUserToken(User $user, string $token_name = null )
    {
        return $user->createToken($token_name)->accessToken;
    }
}
