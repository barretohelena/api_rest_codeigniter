<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemPedido extends Model
{
    protected $table            = 'itens_pedidos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pedido_id', 'produto_id', 'quantidade', 'preco_unitario'];
}
