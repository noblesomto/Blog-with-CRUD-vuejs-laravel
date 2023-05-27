<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function register(Request $request): \Illuminate\Http\JsonResponse
{
        $validateUser = Validator::make($request->all(),
        [
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $user = User::create([
            'user_id' => rand(00000,99999),
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ], 201);

        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'token' => $user->createToken("API_TOKEN")->plainTextToken
        ], 200);

}

public function login(Request $request): \Illuminate\Http\JsonResponse
{
    try {
        //Validated
        $validateUser = Validator::make($request->all(),
            [
                'email' => 'required',
                'password' => 'required'
            ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                $user_id = $user->user_id;
                $request->session()->put('user_id', $user_id);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Email Does not exist.',
                ], 401);
            }
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Password does not Match.',
            ], 401);
        }

        return response()->json([
            'status' => true,
            'user_id' =>$user->user_id,
            'message' => 'Logged In Successfully',
            'token' => $user->createToken("API_TOKEN")->plainTextToken
        ], 200);

    } catch (\Throwable $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}


}
