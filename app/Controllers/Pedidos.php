<?php

namespace App\Controllers;


use App\Helpers\ResponseHelper;
use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Services\PedidoService;
use Exception;


class Pedidos extends BaseController
{
    private Pedido $pedidoModel;
    private PedidoService  $pedidoService;
    private ItemPedido  $itemPedidoModel;

    public function __construct()
    {
        $this->pedidoModel = new Pedido();
        $this->itemPedidoModel = new ItemPedido();
        $this->pedidoService = new PedidoService();
    }

    public function index()
    {
        $page = (int) $this->request->getVar('pagina') ?? 1;
        $perPage = 5;

        $orders = $this->pedidoModel->paginate($perPage, 'default', $page);
        $pager = $this->pedidoModel->pager;

        $ordersIds = array_column($orders, 'id');

        $orderItems = [];
        if (!empty($ordersIds)) {
            $orderItems = $this->itemPedidoModel->whereIn('pedido_id', $ordersIds)->findAll();
        }

        $ordersGrouped = [];
        foreach ($orders as $order) {
            $ordersGrouped[$order['id']] = $order;
            $ordersGrouped[$order['id']]['itens_pedidos'] = [];
        }

        foreach ($orderItems as $item) {
            $ordersGrouped[$item['pedido_id']]['itens_pedidos'][] = $item;
        }

        $data = [
            'dados' => array_values($ordersGrouped),
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
        $order = $this->pedidoModel->find($id) ?? '';

        if (empty($order)) {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_NOT_FOUND)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_NOT_FOUND, 'Pedido não localizado.'));
        }

        $orderItems = $this->itemPedidoModel->whereIn('pedido_id', [$id])->findAll();

        $ordersGrouped = $order;
        foreach ($orderItems as $item) {
            $ordersGrouped['itens_pedidos'][] = $item;
        }

        return $this->response
            ->setContentType('application/json')
            ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS, 'Dados retornados com sucesso.', $ordersGrouped));
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

        try {
            $orderId = $this->pedidoService->createOrder($data);
            return $this->response
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS, 'Pedido cadastrado com sucesso.', ['id_pedido' => $orderId]));

        } catch (Exception $exception) {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_ERROR)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_ERROR, $exception->getMessage()));
        }
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON()->parametros ?? '';

        $pedido = $this->pedidoModel->find($id) ?? '';
        if (empty($pedido)) {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_NOT_FOUND)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_NOT_FOUND, 'Pedido não localizado.'));
        }

        if ($this->pedidoModel->update($id, $data)) {
            return $this->response
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS, 'Pedido atualizado com sucesso.', $data));
        } else {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_ERROR)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_ERROR, $this->pedidoModel->errors()));
        }
    }

    public function delete($id = null)
    {
        $pedido = $this->pedidoModel->find($id) ?? '';
        if (empty($pedido)) {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_NOT_FOUND)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_NOT_FOUND,'Pedido não localizado.'));
        }

        if ($this->pedidoModel->delete($id)) {
            return $this->response
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_SUCCESS,'Pedido excluido com sucesso.', $pedido));
        } else {
            return $this->response
                ->setStatusCode(ResponseHelper::RESPONSE_CODE_ERROR)
                ->setContentType('application/json')
                ->setJSON(ResponseHelper::response(ResponseHelper::RESPONSE_CODE_ERROR, $this->pedidoModel->errors()));
        }
    }
}
