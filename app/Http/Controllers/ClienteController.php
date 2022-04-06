<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteEditRequest;
use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\DestroyManyClientesRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('id')->paginate(15);
        return Inertia::render('Cliente/Index', [
            'clientes' => $clientes,
            'status' => session('status'),
        ]);
    }

    public function create()
    {
        return Inertia::render('Cliente/Create');
    }

    public function store(ClienteStoreRequest $request)
    {
        $cliente = new Cliente();
        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->email = $request->email;
        $cliente->save();

        return redirect()->route('cliente.index')->with('status', 'Cliente cadastrado com sucesso!');
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);

        return Inertia::render('Cliente/Show', [
            'cliente' => $cliente,
        ]);
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return Inertia::render('Cliente/Update', [
            'cliente' => $cliente,
        ]);
    }

    public function update(ClienteEditRequest $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->email = $request->email;
        $cliente->save();

        return redirect()->route('cliente.index')->with('status', 'Cliente atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);
        $cliente->delete();

        return redirect()->route('cliente.index')->with('status', 'Cliente removido com sucesso!');
    }

    public function destroyMany(DestroyManyClientesRequest $request)
    {
        foreach($request->ids as $id) {
            $cliente = Cliente::find($id);
            $cliente->delete();
        }

        return redirect()->route('cliente.index')->with('status', 'Clientes removidos com sucesso!');
    }
}
