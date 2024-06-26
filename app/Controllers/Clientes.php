<?php

namespace App\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Cliente;
use CodeIgniter\RESTful\ResourceController;

class Clientes extends ResourceController
{
    private Cliente $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new Cliente();
    }

    public function index()
    {
        $page = (int) $this->request->getVar('pagina') ?? 1;
        $perPage = 5;

        $customers = $this->clienteModel->paginate($perPage, 'default', $page);
        $pager = $this->clienteModel->pager;

        $data = [
            'dados' => $customers,
            'paginacao' => [
                'total_registros' => $pager->getTotal(),
                'pagina_atual' => $pager->getCurrentPage(),
                'ultima_pagina' => $pager->getLastPage(),
                'registros_por_paginas' => $perPage
            ]
        ];

        return $this->response
            ->setContentType('application/json')
            ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS, 'Dados retornados com sucesso.', $data));

    }

    public function show($id = null)
    {
        $data = $this->clienteModel->find($id) ?? '';

        if (empty($data)) {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_NOT_FOUND)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_NOT_FOUND, 'Cliente não localizado.'));
        }

        return $this->response
            ->setContentType('application/json')
            ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS, 'Dados retornados com sucesso.', $data));
    }

    public function create()
    {
       $data = $this->request->getJSON()->parametros ?? '';

        if (empty($data)) {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_ERROR)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_ERROR, 'Requisição inválida: JSON malformado ou dados ausentes.'));
        }

        if ($this->clienteModel->insert($data)) {
            return $this->response
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS, 'Cliente cadastrado com sucesso.', $data));
        } else {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_ERROR)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_ERROR, $this->clienteModel->errors()));
        }
    }

   public function update($id = null)
   {
       $data = $this->request->getJSON()->parametros ?? '';

       $customers = $this->clienteModel->find($id) ?? '';
       if (empty($customers)) {
           return $this->response
               ->setStatusCode(ResponseHelper::RESPONSE_CODE_NOT_FOUND)
               ->setContentType('application/json')
               ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_NOT_FOUND, 'Cliente não localizado.'));
       }

       if ($this->clienteModel->update($id, $data)) {
           return $this->response
               ->setContentType('application/json')
               ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS, 'Cliente atualizado com sucesso.', $data));
       } else {
           return $this->response
               ->setStatusCode(ResponseHelper::RESPONSE_CODE_ERROR)
               ->setContentType('application/json')
               ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_ERROR, $this->clienteModel->errors()));
       }
   }

   public function delete($id = null)
   {
       $customer = $this->clienteModel->find($id) ?? '';
       if (empty($customer)) {
           return $this->response
               ->setStatusCode(ResponseHelper::RESPONSE_CODE_NOT_FOUND)
               ->setContentType('application/json')
               ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_NOT_FOUND,'Cliente não localizado.'));
       }

       if ($this->clienteModel->delete($id)) {
           return $this->response
               ->setContentType('application/json')
               ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS,'Cliente excluido com sucesso.', $customer));
       } else {
           return $this->response
               ->setStatusCode(ResponseHelper::RESPONSE_CODE_ERROR)
               ->setContentType('application/json')
               ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_ERROR, $this->clienteModel->errors()));
       }
   }
}
