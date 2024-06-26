<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'email' => 'admin@gmail.com',
            'senha' => 'E37tHm7ThYkuk' // admin
        ];

        $this->db->table('usuarios')->insert($data);
    }
}
