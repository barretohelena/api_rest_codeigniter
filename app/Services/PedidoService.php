<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Models\ItemPedido;
use App\Models\Pedido;
use App\Models\Produto;
use Config\Database;
use Exception;

class PedidoService
{
    protected $pedidoModel;
    protected $itemPedidoModel;
    protected $produtoModel;
    protected $db;
    public function __construct()
    {
        $this->pedidoModel = new Pedido();
        $this->itemPedidoModel = new ItemPedido();
        $this->produtoModel = new Produto();
        $this->db = Database::connect();
    }

    public function createOrder($dataOrder)
    {
        $this->db->transStart();

        try {
            $order = [
                'cliente_id' => $dataOrder->cliente_id,
                'data_pedido' => date('Y-m-d H:i:s'),
                'status_pedido' => empty($dataOrder->status_pedido) ? 'pendente' : $dataOrder->status_pedido ,
            ];

            if (empty($dataOrder->cliente_id)) {
                throw new Exception('cliente_id é obrigatório', ResponseHelper::RESPONSE_CODE_ERROR);
            }

            $orderId = $this->pedidoModel->insert($order);

            if (empty($orderId)) {
                throw new Exception('Falha ao cadastrar pedido', ResponseHelper::RESPONSE_CODE_INTERNAL_SERVER_ERROR);
            }

            if (empty($dataOrder->itens_pedidos)) {
                throw new Exception('Lista de itens vazias', ResponseHelper::RESPONSE_CODE_ERROR);
            }

            $totalPedido = 0;
            foreach ($dataOrder->itens_pedidos as $iten) {
                $product = $this->produtoModel->find($iten->iten_id);

                if (empty($product)) {
                    throw new Exception('Produto ' . $iten->iten_id . ' não localizado', ResponseHelper::RESPONSE_CODE_NOT_FOUND);
                }

                $unitPrice = $product['preco'];
                $totalPrice = $unitPrice * $iten->quantidade;

                $dataItems = [
                    'pedido_id' => $orderId,
                    'produto_id' => $iten->iten_id,
                    'quantidade' => $iten->quantidade,
                    'preco_unitario' => $unitPrice
                ];

                if ($this->itemPedidoModel->insert($dataItems) == false) {
                    throw new Exception('Falha ao cadastrar itens do pedido', ResponseHelper::RESPONSE_CODE_INTERNAL_SERVER_ERROR);
                }

                $totalPedido += $totalPrice;
            }

            if ($this->pedidoModel->update($orderId, ['total_pedido' => $totalPedido])) {
                $this->db->transComplete();
            } else {
                throw new Exception('Falha ao atualizar valor total do pedido', ResponseHelper::RESPONSE_CODE_INTERNAL_SERVER_ERROR);
            }

            return $orderId;

        } catch (Exception $exception) {
            $this->db->transRollback();
            throw $exception;
        }
    }
}