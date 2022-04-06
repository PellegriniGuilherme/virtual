<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyManyProdutosRequest;
use App\Http\Requests\ProdutoEditRequest;
use App\Http\Requests\ProdutoStoreRequest;
use App\Models\Produto;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::orderBy('id')->paginate(15);
        return Inertia::render('Produto/Index', [
            'produtos' => $produtos,
            'status' => session('status'),
        ]);
    }

    public function create()
    {
        return Inertia::render('Produto/Create');
    }

    public function store(ProdutoStoreRequest $request)
    {
        $produto = new Produto();
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->valor_unitario = $request->valor_unitario;
        $produto->save();

        return redirect()->route('produto.index')->with('status', 'Produto cadastrado com sucesso!');
    }

    public function show($id)
    {
        $produto = Produto::find($id);

        return Inertia::render('Produto/Show', [
            'produto' => $produto,
        ]);
    }

    public function edit($id)
    {
        $produto = Produto::find($id);

        return Inertia::render('Produto/Update', [
            'produto' => $produto,
        ]);
    }

    public function update(ProdutoEditRequest $request, $id)
    {
        $produto = Produto::find($id);
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->valor_unitario = $request->valor_unitario;
        $produto->save();

        return redirect()->route('produto.index')->with('status', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();

        return redirect()->route('produto.index')->with('status', 'Produto removido com sucesso!');
    }

    public function destroyMany(DestroyManyProdutosRequest $request)
    {
        foreach($request->ids as $id) {
            $produto = Produto::find($id);
            $produto->delete();
        }

        return redirect()->route('produto.index')->with('status', 'Produtos removidos com sucesso!');
    }

}
