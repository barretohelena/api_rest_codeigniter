<?php

namespace App\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Usuario;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class Auth extends ResourceController
{
    private Usuario $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new Usuario();
    }

    public function login()
    {
        $rules = [
            'login' => 'required|valid_email',
            'senha' => 'required'
        ];

        $messages = [
            'login' => [
                'required' => 'login não informado.',
                'valid_email' => 'Login deve ser um e-mail válido.'
            ],
            'senha' => [
                'required' => 'Senha não informado.',
            ],
        ];

        if ($this->validate($rules, $messages) == false) {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_UNAUTHORIZED)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_UNAUTHORIZED, $this->validator->getErrors()));
        }

        $data = $this->request->getJSON();
        $login = $data->login;
        $password = $data->senha;

        $user = $this->validatePassword($login, $password);

        if ($user == false) {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_UNAUTHORIZED)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_UNAUTHORIZED, 'Login ou senha invádos'));
        }

        $payload = [
            'iss' => getenv('jwt.iss'),
            'aud' => getenv('jwt.aud'),
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + getenv('jwt.exp'),
            'data' => [
                'id' => $user['id'],
                'email' => $user['email']
            ]
        ];
        $token = JWT::encode($payload, getenv('encryption.key'), 'HS256');

        return $this->response
            ->setStatusCode(ResponseHelper::RESPONSE_CODE_SUCCESS)
            ->setContentType('application/json')
            ->setJSON(ResponseHelper::response(
                ResponseHelper::RESPONSE_CODE_SUCCESS,
                'Token gerado com sucesso',
                [
                    'token' => $token,
                    'expire_in' => time() + getenv('jwt.exp')
                ]
            ));
    }

    public function validatePassword($login, $password)
    {
        $user = $this->usuarioModel->where('email', $login)->first();

        if (empty($user)) {
            return false;
        }

        if (password_verify($password, $user['senha']) == false) {
            return false;
        }

        return $user;
    }
}