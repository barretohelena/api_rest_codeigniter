<?php

namespace App\Filters;

use App\Helpers\ResponseHelper;
use Config\Services;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->header("Authorization");
        if ($authHeader) {
            $authHeader = $authHeader->getValue();
            $arr = explode(" ", $authHeader);
            $token = $arr[1];

            try {
                JWT::decode($token, new Key(getenv('encryption.key'), 'HS256'));

            } catch (Exception) {
                return Services::response()
                    ->setStatusCode(ResponseHelper::RESPONSE_CODE_UNAUTHORIZED)
                    ->setContentType('application/json')
                    ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_UNAUTHORIZED, 'Token inválido.'));
            }
        } else {
            return Services::response()
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_UNAUTHORIZED)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_UNAUTHORIZED, 'Token não informado.'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}