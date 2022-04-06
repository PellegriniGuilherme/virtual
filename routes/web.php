<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthenticatedSessionController::class, 'create']);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('cliente', ClienteController::class);
    Route::delete('clientes/destroy', [ClienteController::class, 'destroyMany'])->name('cliente.destroyMany');

    Route::resource('produto', ProdutoController::class);
    Route::delete('produtos/destroy', [ProdutoController::class, 'destroyMany'])->name('produto.destroyMany');

    Route::resource('pedido', PedidoController::class);
    Route::post('pedido/{id}/produto', [PedidoController::class, 'addProduto'])->name('pedido.addProduto');
    Route::delete('pedido/produto/{id}/destroy', [PedidoController::class, 'deleteProduto'])->name('pedido.deleteProduto');
    Route::delete('pedidos/destroy', [PedidoController::class, 'destroyMany'])->name('pedido.destroyMany');
});

require __DIR__.'/auth.php';
