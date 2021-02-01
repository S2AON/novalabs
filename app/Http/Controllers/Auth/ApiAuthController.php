<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        //Request values validation
        $validator = Validator::make($request->only(['email','password']), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //If the validation fails we send an error message to
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 406);
        }

        //We attempt to retrieve the user data by looking for the email address
        $user = User::whereEmail($request->email)->first();

        //We evaluate if the result was null or not, and if the password is the same
        if(!is_null($user) && Hash::check($request->password, $user->password)){

            //Token creating
            $auth = $user->createToken('authToken');

            //We return a json response with the use data and the new token
            return response()->json
            ([
                'user' => $user,
                'access_token' => $auth->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($auth->token->expires_at)->toDateTimeString()
            ]);
        }
        else
        {
            return response()->json(['error' => 'incorrect username or password'], 401);
        }

    }

    public function register(Request $request)
    {
        //Request values validation
        $validator = Validator::make($request->only(['email','name','password']),
        [
            'email' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'name' => 'required|string',
        ]);

        //If the validation fails we send an error message to
        if ($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        //We proceed with the user creation
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(10),
        ]);

        //Token creating
        $auth = $user->createToken('authToken');

        //We return a json response with the use data and the new token
        return response()->json
        ([
            'message' => 'User registered successfully',
            'user' => $user,
            'access_token' => $auth->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($auth->token->expires_at)->toDateTimeString()
        ]);

    }

    public function logout (Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];

        return response($response, 200);

    }
}
