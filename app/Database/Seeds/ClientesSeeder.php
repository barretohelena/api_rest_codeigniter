<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClientesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'cpf_cnpj' => '123.456.789-00',
                'nome_razao_social' => 'João Silva',
                'email' => 'joao@gmail.com',
            ],
            [
                'cpf_cnpj' => '987.654.321-00',
                'nome_razao_social' => 'Maria Souza',
                'email' => 'maria@gmail.com',
            ],
            [
                'cpf_cnpj' => '456.789.123-00',
                'nome_razao_social' => 'Carlos Pereira',
                'email' => 'carlos@gmail.com',
            ],
            [
                'cpf_cnpj' => '789.123.456-00',
                'nome_razao_social' => 'Ana Lima',
                'email' => 'ana@gmail.com',
            ],
            [
                'cpf_cnpj' => '321.654.987-00',
                'nome_razao_social' => 'Pedro Costa',
                'email' => 'pedro@gmail.com',
            ],
            [
                'cpf_cnpj' => '654.321.789-00',
                'nome_razao_social' => 'Julia Mendes',
                'email' => 'julia@gmail.com',
            ],
            [
                'cpf_cnpj' => '789.456.123-00',
                'nome_razao_social' => 'Fernando Albuquerque',
                'email' => 'fernando@gmail.com',
            ],
            [
                'cpf_cnpj' => '123.789.456-00',
                'nome_razao_social' => 'Mariana Castro',
                'email' => 'mariana@gmail.com',
            ],
            [
                'cpf_cnpj' => '456.123.789-00',
                'nome_razao_social' => 'Paulo Gonçalves',
                'email' => 'paulo@gmail.com',
            ],
            [
                'cpf_cnpj' => '789.654.321-00',
                'nome_razao_social' => 'Renata Dias',
                'email' => 'renata@gmail.com',
            ],
            [
                'cpf_cnpj' => '654.789.123-00',
                'nome_razao_social' => 'Bruno Martins',
                'email' => 'bruno@gmail.com',
            ],
            [
                'cpf_cnpj' => '123.321.654-00',
                'nome_razao_social' => 'Simone Barbosa',
                'email' => 'simone@gmail.com',
            ],
            [
                'cpf_cnpj' => '321.123.654-00',
                'nome_razao_social' => 'Lucas Nogueira',
                'email' => 'lucas@gmail.com',
            ],
            [
                'cpf_cnpj' => '654.654.123-00',
                'nome_razao_social' => 'Roberta Farias',
                'email' => 'roberta@gmail.com',
            ],
            [
                'cpf_cnpj' => '789.789.456-00',
                'nome_razao_social' => 'Gabriel Mendes',
                'email' => 'gabriel@gmail.com',
            ],
            [
                'cpf_cnpj' => '123.123.789-00',
                'nome_razao_social' => 'Juliana Almeida',
                'email' => 'juliana@gmail.com',
            ],
            [
                'cpf_cnpj' => '456.456.123-00',
                'nome_razao_social' => 'Thiago Silva',
                'email' => 'thiago@gmail.com',
            ],
            [
                'cpf_cnpj' => '321.321.456-00',
                'nome_razao_social' => 'Fernanda Moreira',
                'email' => 'fernanda@gmail.com',
            ],
            [
                'cpf_cnpj' => '654.654.789-00',
                'nome_razao_social' => 'Marcelo Teixeira',
                'email' => 'marcelo@gmail.com',
            ],
            [
                'cpf_cnpj' => '789.123.321-00',
                'nome_razao_social' => 'Claudia Ramos',
                'email' => 'claudia@gmail.com',
            ]
        ];

        $this->db->table('clientes')->insertBatch($data);
    }
}
