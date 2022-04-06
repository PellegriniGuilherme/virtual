<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyManyPedidosRequest;
use App\Http\Requests\PedidoDeleteProdutoRequest;
use App\Http\Requests\PedidoEditRequest;
use App\Http\Requests\PedidoStoreRequest;
use App\Http\Requests\RequestAddProduto;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Inertia\Inertia;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::orderBy('id')->with('cliente')->with('produtos')->paginate(15);
        return Inertia::render('Pedido/Index', [
            'pedidos' => $pedidos,
            'status' => session('status'),
        ]);
    }

    public function create()
    {
        $produtos = Produto::all();
        $clientes = Cliente::all();

        return Inertia::render('Pedido/Create', [
            'produtos' => $produtos,
            'clientes' => $clientes,
        ]);
    }

    public function store(PedidoStoreRequest $request)
    {
        $pedido = new Pedido();
        $pedido->cliente_id = $request->cliente_id;
        $pedido->save();

        foreach($request->produtos as $produto){
            $pedidoProdutos = new PedidoProduto();
            $pedidoProdutos->pedido_id = $pedido->id;
            $pedidoProdutos->produto_id = $produto['produto_id'];
            $pedidoProdutos->quantidade = $produto['quantidade'];
            $pedidoProdutos->save();
        }
        
        return redirect()->route('pedido.index')->with('status', 'Pedido cadastrado com sucesso!');
    }

    public function show($id)
    {
        $pedido = Pedido::find($id)->with('cliente')->with('produtos')->first();

        return Inertia::render('Pedido/Show', [
            'pedido' => $pedido,
        ]);
    }

    public function edit($id)
    {
        $pedido = Pedido::find($id)->with('cliente')->with('produtos')->first();
        $clientes = Cliente::all();
        $produtos = Produto::all();

        return Inertia::render('Pedido/Update', [
            'produtos' => $produtos,
            'pedido' => $pedido,
            'clientes' => $clientes,
            'status' => session('status'),
        ]);
    }

    public function update(PedidoEditRequest $request, $id)
    {
        $pedido = Pedido::find($id);
        $pedido->cliente_id = $request->cliente_id;
        $pedido->save();

        return redirect()->route('pedido.index')->with('status', 'Pedido atualizado com sucesso!');
    }

    public function addProduto(RequestAddProduto $request, $id)
    {
        $pedido = Pedido::find($id);
        $produto = PedidoProduto::where('pedido_id', $pedido->id)->where('produto_id', $request->produto_id)->first();
        if($produto){
            $produto->quantidade += $request->quantidade;
            $produto->save();

            return redirect()->route('pedido.edit', $id)->with('status', 'Produto atualizado ao pedido!');
        }

        $pedidoProdutos = new PedidoProduto();
        $pedidoProdutos->pedido_id = $pedido->id;
        $pedidoProdutos->produto_id = $request->produto_id;
        $pedidoProdutos->quantidade = $request->quantidade;
        $pedidoProdutos->save();

        return redirect()->route('pedido.edit', $id)->with('status', 'Produto adicionado com sucesso!');

    }

    public function deleteProduto($id)
    {
        $pedidoProduto = PedidoProduto::find($id);
        $pedido = Pedido::find($pedidoProduto->pedido_id);
        $pedidoProduto->delete();

        return redirect()->route('pedido.edit', $pedido->id)->with('status', 'Produto removido com sucesso!');
    }
    
    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedidoProdutos = $pedido->produtos()->get();
        foreach($pedidoProdutos as $pedidoProduto){
            $pedidoProduto->delete();
        }
        $pedido->delete();

        return redirect()->route('pedido.index')->with('status', 'Pedido removido com sucesso!');
    }

    public function destroyMany(DestroyManyPedidosRequest $request)
    {
        foreach($request->ids as $id) {
            $pedido = Pedido::find($id);
            $pedidoProdutos = $pedido->produtos()->get();
            foreach($pedidoProdutos as $pedidoProduto){
                $pedidoProduto->delete();
            }
            $pedido->delete();
            unset($pedidoProduto);
        }

        return redirect()->route('pedido.index')->with('status', 'Pedidos removidos com sucesso!');
    }
}
