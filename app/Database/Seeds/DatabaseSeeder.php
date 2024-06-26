<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('UsuariosSeeder');
        $this->call('ClientesSeeder');
        $this->call('ProdutosSeeder');
        $this->call('PedidosSeeder');
        $this->call('ItensPedidosSeeder');
    }
}
