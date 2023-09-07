<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Str;

class LoginController extends Controller
{
    /**
     * Proceed Register.
     */
    public function register(Request $request)
    {
        $params = $request->only(['name', 'email', 'password']);
        $params['password'] = bcrypt($params['password']);

        $user = User::create($params);
        $user->createToken('api_token')->plainTextToken;

        return response([
        	'message' => 'Register Succesfull'
        ], 200);
    }

    /**
     * Proceed login.
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        
        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
        	$user = User::where('email', $credentials['email'])->first();
            return response([
            	'message' => 'Login Success',
            	'data' => [
            		'user' => $user,
            		'token' => $user->createToken('api_token')->plainTextToken
            	]
            ], 200);
        }else {
            Auth::logout();
            // request()->session()->invalidate();
            // request()->session()->regenerateToken();

            return response([
            	'message' => 'Username or password incorrect',
            ], 401);
        }
    }

    /**
     * Proceed logout.
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return response([
        	'message' => 'Logout Success',
        ], 200);
    }
}
