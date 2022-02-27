<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oportunidades;


class OportunidadesController extends Controller
{
    private $oportunidade;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Oportunidades $oportunidade) {
        $this->oportunidade = $oportunidade;
    }

    public function index() {
        return $this->oportunidade->paginate(10);
    }

    public function show($oportunidade) {
        return $this->oportunidade->find($oportunidade);
    }

    public function store(Request $request) {
        $this->oportunidade->create($request->all());
        return response()->json(['data' => ['message' => 'Criado com sucesso!']]);
    }

    public function update($oportunidade, Request $request) {
        $oportunidade = $this->oportunidade->find($oportunidade);

        $oportunidade->update($request->all());
        return response()->json(['data' => ['message' => 'Atualizado com sucesso!']]);
    }

    public function destroy($oportunidade) {
        $oportunidade = $this->oportunidade->find($oportunidade);

        $oportunidade->delete();
        return response()->json(['data' => ['message' => 'Deletado com sucesso!']]);
    }
}
