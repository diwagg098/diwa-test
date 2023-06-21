<?php

namespace App\Helpers;

class ApiFormatter
{
    protected static $response = [
        "code" => null,
        "message" => null,
        "data" => null,
        "paginate" => null,
    ];

    public static function buildResponse($code = null, $message = null, $data = null, $paginate = null){
        self::$response['code'] = $code;
        self::$response['message'] = $message;
        self::$response['data'] = $data;
        self::$response['paginate'] = $paginate;

        return response()->json(self::$response, self::$response['code']);
    }
}