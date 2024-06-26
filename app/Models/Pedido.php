<?php

namespace App\Models;

use CodeIgniter\Model;

class Pedido extends Model
{
    protected $table            = 'pedidos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['cliente_id', 'data_pedido', 'total_pedido', 'status_pedido'];
}
