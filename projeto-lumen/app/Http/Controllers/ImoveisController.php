<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imoveis;


class ImoveisController extends Controller
{
    private $imoveis;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Imoveis $imoveis) {
        $this->imoveis = $imoveis;
    }

    public function index() {
        return $this->imoveis->paginate(10);
    }

    public function show($imovel) {
        return $this->imoveis->find($imovel);
    }

    public function store(Request $request) {
        $this->imoveis->create($request->all());
        return response()->json(['data' => ['message' => 'Criado com sucesso!']]);
    }

    public function update($imovel, Request $request) {
        $imoveis = $this->imoveis->find($imovel);

        $imoveis->update($request->all());
        return response()->json(['data' => ['message' => 'Atualizado com sucesso!']]);
    }

    public function destroy($imovel) {
        $imoveis = $this->imoveis->find($imovel);

        $imoveis->delete();
        return response()->json(['data' => ['message' => 'Deletado com sucesso!']]);
    }
}
