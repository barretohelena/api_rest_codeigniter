<?php

namespace App\Models;

use CodeIgniter\Model;

class Cliente extends Model
{
    protected $table            = 'clientes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['cpf_cnpj', 'nome_razao_social', 'email'];

    protected $validationRules = [
        'cpf_cnpj' => 'required|regex_match[/^\d{3}\.\d{3}\.\d{3}-\d{2}$/]|is_unique[clientes.cpf_cnpj]',
        'nome_razao_social' => 'required|string|max_length[255]',
        'email' => 'required|valid_email|is_unique[clientes.email]'
    ];

    protected $validationMessages = [
        'cpf_cnpj' => [
            'required' => 'CPF/CNPJ é obrigatório.',
            'regex_match' => 'CPF/CNPJ  inválido.',
            'is_unique' => 'CPF/CNPJ já está cadastrado.'
        ],
        'nome_razao_social' => [
            'required' => 'Nome/Razão Social é obrigatório.',
            'string' => 'Nome/Razão Social deve ser uma string.',
            'max_length' => 'Nome/Razão Social não pode exceder 255 caracteres.'
        ],
        'email' => [
            'required' => 'Email é obrigatório.',
            'valid_email' => 'Email deve conter um endereço de email válido.',
            'is_unique' => 'Email já está cadastrado.'
        ]
    ];
}
