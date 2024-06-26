<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pedidos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'cliente_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'data_pedido' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'total_pedido' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'status_pedido' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('cliente_id', 'clientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pedidos', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('pedidos');
        $this->forge->dropForeignKey('pedidos', 'pedidos_cliente_id_foreign');
    }
}
