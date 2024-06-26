<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ItensPedidos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'pedido_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'produto_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'quantidade' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'preco_unitario' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pedido_id', 'pedidos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('produto_id', 'produtos', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('itens_pedidos', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('itens_pedidos');
        $this->forge->dropForeignKey('itens_pedidos', 'itens_pedidos_pedido_id_foreign');
        $this->forge->dropForeignKey('itens_pedidos', 'itens_pedidos_produto_id_foreign');
    }
}
