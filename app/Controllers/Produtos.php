<?php

namespace App\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\Produto;

class Produtos extends BaseController
{
    private Produto $produtoModel;

    public function __construct()
    {
        $this->produtoModel = new Produto();
    }

    public function index()
    {
        $page = (int) $this->request->getVar('pagina') ?? 1;
        $perPage = 5;

        $produtos = $this->produtoModel->paginate($perPage, 'default', $page);
        $pager = $this->produtoModel->pager;

        $data = [
            'dados' => $produtos,
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
        $data = $this->produtoModel->find($id) ?? '';

        if (empty($data)) {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_NOT_FOUND)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_NOT_FOUND, 'Produto não localizado.'));
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

        if ($this->produtoModel->insert($data)) {
            return $this->response
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS, 'Produto cadastrado com sucesso.', $data));
        } else {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_ERROR)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_ERROR, $this->produtoModel->errors()));
        }
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON()->parametros ?? '';

        $produto = $this->produtoModel->find($id) ?? '';
        if (empty($produto)) {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_NOT_FOUND)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_NOT_FOUND, 'Produto não localizado.'));
        }

        if ($this->produtoModel->update($id, $data)) {
            return $this->response
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS, 'Produto atualizado com sucesso.', $data));
        } else {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_ERROR)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_ERROR, $this->produtoModel->errors()));
        }
    }

    public function delete($id = null)
    {
        $produto = $this->produtoModel->find($id) ?? '';
        if (empty($produto)) {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_NOT_FOUND)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_NOT_FOUND,'Produto não localizado.'));
        }

        if ($this->produtoModel->delete($id)) {
            return $this->response
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS,'Produto excluido com sucesso.', $produto));
        } else {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_ERROR)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_ERROR, $this->produtoModel->errors()));
        }
    }
}
