<?php

namespace App\Models;

use CodeIgniter\Model;

class Produto extends Model
{
    protected $table            = 'produtos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nome', 'descricao', 'preco', 'estoque'];

    protected $validationRules = [
        'nome' => 'required|string|is_unique[produtos.nome]|max_length[255]',
        'descricao' => 'string|max_length[255]',
        'preco' => 'required|decimal',
        'estoque' => 'required|integer|greater_than_equal_to[0]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required' => 'Nome do produto é obrigatório.',
            'is_unique' => 'Nome de produto já existe.',
            'max_length' => 'Nome do produto não pode ter mais de 255 caracteres.'
        ],
        'descricao' => [
            'required' => 'Descrição do produto é obrigatória.',
            'max_length' => 'Descrição não pode ter mais de 255 caracteres.'
        ],
        'preco' => [
            'required' => 'Preço do produto é obrigatório.',
            'decimal' => 'Preço do produto deve ser um valor decimal.'
        ],
        'estoque' => [
            'required' => 'Estoque do produto é obrigatório.',
            'integer' => 'Estoque do produto deve ser um valor inteiro.',
            'greater_than_equal_to' => 'Estoque do produto deve ser um valor positivo.'
        ]
    ];

}
