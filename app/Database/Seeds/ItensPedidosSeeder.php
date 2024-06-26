<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ItensPedidosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'pedido_id' => 1,
                'produto_id' => 1,
                'quantidade' => 1,
                'preco_unitario' => 4033.00,
            ],
            [
                'pedido_id' => 2,
                'produto_id' => 1,
                'quantidade' => 1,
                'preco_unitario' => 4033.00,
            ],
            [
                'pedido_id' => 2,
                'produto_id' => 2,
                'quantidade' => 1,
                'preco_unitario' => 150.00,
            ],
            [
                'pedido_id' => 3,
                'produto_id' => 5,
                'quantidade' => 1,
                'preco_unitario' => 1200.00,
            ],
            [
                'pedido_id' => 3,
                'produto_id' => 6,
                'quantidade' => 1,
                'preco_unitario' => 1100.00,
            ],
            [
                'pedido_id' => 4,
                'produto_id' => 1,
                'quantidade' => 1,
                'preco_unitario' => 4033.00,
            ],
            [
                'pedido_id' => 5,
                'produto_id' => 1,
                'quantidade' => 2,
                'preco_unitario' => 4033.00,
            ],
            [
                'pedido_id' => 6,
                'produto_id' => 5,
                'quantidade' => 1,
                'preco_unitario' => 1200.00,
            ],
            [
                'pedido_id' => 6,
                'produto_id' => 6,
                'quantidade' => 1,
                'preco_unitario' => 1100.00,
            ],
            [
                'pedido_id' => 7,
                'produto_id' => 1,
                'quantidade' => 1,
                'preco_unitario' => 4033.00,
            ],
        ];

        $this->db->table('itens_pedidos')->insertBatch($data);
    }
}
