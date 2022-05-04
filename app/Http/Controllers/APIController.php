<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIController extends Controller
{
    // methods to handle API responses

    public function sendResponse($data, $message, $status = 200)
    {
        $response = [
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response, $status);
    }

    public function sendError($message, $errorData = [], $status = 400)
    {
        $response = [
            'message' => $message
        ];

        if(!empty($errorData)) {
            $response['data'] = $errorData;
        }

        return response()->json($response, $status);
    }

    public function resourceNotFoundResponse(string $resource)
    {
        $response = [
            'error' => "The $resource wasn't found",
        ];

        return response()->json($response, 404);
    }
}
