<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id'
    ];

    protected $casts = [
        'id' => 'integer',
        'cliente_id' => 'integer',
        'data' => 'datetime:d/m/Y H:i:s'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function produtos()
    {
        return $this->hasMany(PedidoProduto::class)->with('produto');
    }
}
