<?php

namespace App\Helpers;

class ResponseHelper
{
    const RESPONSE_CODE_SUCCESS = 200;
    const RESPONSE_CODE_ERROR = 400;
    const RESPONSE_CODE_UNAUTHORIZED = 401;
    const RESPONSE_CODE_NOT_FOUND = 404;
    const RESPONSE_CODE_INTERNAL_SERVER_ERROR = 500;

    public static function response($code, $message = '', $data = [])
    {
        $response = [
            'cabecalho' => [
                'status' => $code,
                'mensagem' => $message
            ],
            'retorno' => $data
        ];

        return $response;
    }

    public static function successResponse($data, $message = '')
    {
        $response = [
            'cabecalho' => [
                'status' => self::RESPONSE_CODE_SUCCESS,
                'mensagem' => $message
            ],
            'retorno' => $data
        ];

        return $response;
    }

    public static function notFoundResponse($message = '')
    {
        $response = [
            'cabecalho' => [
                'status' => self::RESPONSE_CODE_NOT_FOUND,
                'mensagem' => $message
            ],
            'retorno' => []
        ];

        return $response;
    }

    public static function badRequestResponse($message = '')
    {
        $response = [
            'cabecalho' => [
                'status' => self::RESPONSE_CODE_ERROR,
                'mensagem' => $message
            ],
            'retorno' => []
        ];

        return $response;
    }

}