<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;


class ClientesController extends Controller
{
    private $cliente;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Clientes $cliente) {
        $this->cliente = $cliente;
    }

    public function index() {
        return $this->cliente->paginate(10);
    }

    public function show($cliente) {
        return $this->cliente->find($cliente);
    }

    public function store(Request $request) {
        $this->cliente->create($request->all());
        return response()->json(['data' => ['message' => 'Criado com sucesso!']]);
    }

    public function update($cliente, Request $request) {
        $cliente = $this->cliente->find($cliente);

        $cliente->update($request->all());
        return response()->json(['data' => ['message' => 'Atualizado com sucesso!']]);
    }

    public function destroy($cliente) {
        $cliente = $this->cliente->find($cliente);

        $cliente->delete();
        return response()->json(['data' => ['message' => 'Deletado com sucesso!']]);
    }
}
