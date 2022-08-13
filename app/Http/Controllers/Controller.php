<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse($message = "", $data = [], $status = Response::HTTP_OK, $success = true)
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public function sendResponseWithToken($token, $success = true, $status = Response::HTTP_OK)
    {
        return response()->json([
            'success' => $success,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], $status);
    }

    public function sendError($message = "", $status = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
