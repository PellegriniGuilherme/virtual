<?php

namespace Database\Seeders;

use App\Models\Pedido;
use App\Models\PedidoProduto;
use Illuminate\Database\Seeder;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pedido::factory()->count(100)->create()->each(function ($pedido) {
            PedidoProduto::factory()->count(rand(2, 8))->create(['pedido_id' => $pedido->id]);
        });
    }
}
