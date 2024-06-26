<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nome' => 'Notebook',
                'descricao' => 'Notebook Dell',
                'preco' => 4033.00,
                'estoque' => 100
            ],
            [
                'nome' => 'Mouse',
                'descricao' => 'Mouse Logitech',
                'preco' => 150.00,
                'estoque' => 200
            ],
            [
                'nome' => 'Teclado',
                'descricao' => 'Teclado Mecânico',
                'preco' => 350.00,
                'estoque' => 150
            ],
            [
                'nome' => 'Monitor',
                'descricao' => 'Monitor Samsung 24"',
                'preco' => 899.00,
                'estoque' => 80
            ],
            [
                'nome' => 'Impressora',
                'descricao' => 'Impressora HP',
                'preco' => 1200.00,
                'estoque' => 50
            ],
            [
                'nome' => 'Cadeira Gamer',
                'descricao' => 'Cadeira Gamer DXRacer',
                'preco' => 1100.00,
                'estoque' => 60
            ],
            [
                'nome' => 'Webcam',
                'descricao' => 'Webcam Logitech C920',
                'preco' => 350.00,
                'estoque' => 90
            ],
            [
                'nome' => 'Fone de Ouvido',
                'descricao' => 'Fone de Ouvido Sony',
                'preco' => 200.00,
                'estoque' => 120
            ],
            [
                'nome' => 'Smartphone',
                'descricao' => 'Smartphone Samsung Galaxy',
                'preco' => 2500.00,
                'estoque' => 70
            ],
            [
                'nome' => 'Tablet',
                'descricao' => 'Tablet Apple iPad',
                'preco' => 3300.00,
                'estoque' => 40
            ],
            [
                'nome' => 'HD Externo',
                'descricao' => 'HD Externo Seagate 1TB',
                'preco' => 400.00,
                'estoque' => 200
            ],
            [
                'nome' => 'SSD',
                'descricao' => 'SSD Kingston 240GB',
                'preco' => 350.00,
                'estoque' => 180
            ],
            [
                'nome' => 'Fonte',
                'descricao' => 'Fonte Corsair 600W',
                'preco' => 550.00,
                'estoque' => 110
            ],
            [
                'nome' => 'Placa Mãe',
                'descricao' => 'Placa Mãe ASUS',
                'preco' => 750.00,
                'estoque' => 90
            ],
            [
                'nome' => 'Memória RAM',
                'descricao' => 'Memória RAM 16GB DDR4',
                'preco' => 800.00,
                'estoque' => 140
            ],
            [
                'nome' => 'Gabinete',
                'descricao' => 'Gabinete Cooler Master',
                'preco' => 450.00,
                'estoque' => 100
            ],
            [
                'nome' => 'Placa de Vídeo',
                'descricao' => 'Placa de Vídeo NVIDIA GTX 1660',
                'preco' => 2000.00,
                'estoque' => 70
            ],
            [
                'nome' => 'Processador',
                'descricao' => 'Processador Intel i7',
                'preco' => 1800.00,
                'estoque' => 60
            ],
            [
                'nome' => 'Cooler',
                'descricao' => 'Cooler para CPU',
                'preco' => 120.00,
                'estoque' => 130
            ],
            [
                'nome' => 'Pen Drive',
                'descricao' => 'Pen Drive 64GB',
                'preco' => 80.00,
                'estoque' => 250
            ]
        ];

        $this->db->table('produtos')->insertBatch($data);
    }
}
