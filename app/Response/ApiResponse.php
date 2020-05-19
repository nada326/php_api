<?php

namespace App\Response;

use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;

trait ApiResponse
{
    public function sendResponse($data, string $messageSuccess, int $code)
    {
        $response = [
            'status' => in_array($code,$this->successCode()) ? true : false,
            'data' => $data,
            'message' => $messageSuccess
        ];
        return response()->json($response, $code);
    }

    public function sendError(string $message , MessageBag $errorMessages, int $code = 404)
    {
        $response = [
            'status' => in_array($code, $this->successCode())? true : false,
            'message' => $message
        ];
        if(!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    private function successCode(): array
    {
        return [200, 201, 202];
    }
}
