<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oportunidades extends Model {
    protected $fillable = ['imoveis_id', 'clientes_id'];
}