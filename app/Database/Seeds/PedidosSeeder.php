<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PedidosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'cliente_id' => 1,
                'data_pedido' => date('Y-m-d H:i:s'),
                'total_pedido' => 4033.00,
                'status_pedido' => 'Em aberto',
            ],
            [
                'cliente_id' => 2,
                'data_pedido' => date('Y-m-d H:i:s'),
                'total_pedido' => 4183.00,
                'status_pedido' => 'Pago',
            ],
            [
                'cliente_id' => 8,
                'data_pedido' => date('Y-m-d H:i:s'),
                'total_pedido' => 2300.00,
                'status_pedido' => 'Pago',
            ],
            [
                'cliente_id' => 10,
                'data_pedido' => date('Y-m-d H:i:s'),
                'total_pedido' => 4033.00,
                'status_pedido' => 'Cancelado',
            ],
            [
                'cliente_id' => 11,
                'data_pedido' => date('Y-m-d H:i:s'),
                'total_pedido' => 8600.00,
                'status_pedido' => 'Em aberto',
            ],
            [
                'cliente_id' => 3,
                'data_pedido' => date('Y-m-d H:i:s'),
                'total_pedido' => 2300.00,
                'status_pedido' => 'Pago',
            ],
            [
                'cliente_id' => 3,
                'data_pedido' => date('Y-m-d H:i:s'),
                'total_pedido' => 4033.00,
                'status_pedido' => 'Pago',
            ],
        ];

        $this->db->table('pedidos')->insertBatch($data);
    }
}
