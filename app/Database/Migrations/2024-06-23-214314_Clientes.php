<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cliente extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true,
            ],
            'cpf_cnpj' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
            ],
            'nome_razao_social' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('clientes', true, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('clientes');
    }
}
