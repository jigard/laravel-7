<?php

namespace App\Http\Controllers\API;

use Hash;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * this method is created dynamically using stub
     * @param $request
     * @return 
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * register user api and return token
     * @param $request
     * @return $token
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json(['token' => $token], 200);
    }

    /**
     * check user exist or not with email and password with device_name and return token
     * @param $request
     * @return $token
     */
    public function token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['email or password is wrong'], 422);
        }

        return response()->json(['token' => $user->createToken($request->device_name)->plainTextToken]);
    }
}
