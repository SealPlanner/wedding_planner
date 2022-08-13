<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return $this->sendResponse('Missing parameter', $validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY, false);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return $this->sendResponse('Unauthorized', [], Response::HTTP_UNAUTHORIZED, false);
        }
        return $this->sendResponseWithToken($token);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return $this->sendResponse($user, 'Successfully created user', Response::HTTP_CREATED);
    }

    public function logout()
    {
        auth()->logout();

        return $this->sendResponse('successfully logged out');
    }

    public function refresh()
    {
        return $this->sendResponseWithToken(auth()->refresh());
    }
}
