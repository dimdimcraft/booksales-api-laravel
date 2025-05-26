<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
    // validator
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

    // cek validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    // create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

    // cek keberhasilan
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User registered successfully',
                'data' => $user,
            ], 201);
        }

    // cek gagal
        return response()->json([
            'success' => false,
            'message' => 'User registration failed',
        ], 409);
    }

    public function login(Request $request)
    {
        // validator
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // cek validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // get kredensial dari request
        $credentials = $request->only('email', 'password');
        
        // cek isfailed
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'email atau password salah',
            ], 401);
        }

        // cek issuccess
        return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'user' => auth()->guard('api')->user(),
                'token' => $token,
            ], 200);    
    }

    public function logout(Request $request)
    {
        // try catch
        // invalidate token
        // cek if success
        // catch
        // cek if failed

        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'success' => true,
                'message' => 'Logout successful',
            ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout failed',
                'error' => $e->getMessage(),
            ], 500);
        }

    }
}
