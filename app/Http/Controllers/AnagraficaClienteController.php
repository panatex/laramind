<?php

namespace App\Http\Controllers;

use App\Models\AnagraficaClienti;
use Illuminate\Http\Request;

class AnagraficaClienteController extends Controller
{
    //
    public function index()
    {
        $clienteM = new AnagraficaClienti();
        //imposto i filtri where che possono essere molteplici
        $arWhere = [
            ['nome', 'like', 'P%']
        ];
        //tiro su solo due colonne
        //fare la query davanbti ed in fondo il get con le colonne volute
        $dataC = $clienteM::where($arWhere)->orderBy('id', 'desc')->get(['id','nome', 'cognome']);

        return view('anagrafica-cliente.index')->with(['dataC' => $dataC]);
    }

    public function create()
    {

    }


    public function show($id)
    {

    }

    public function store(Request $request)
    {

    }

    public function update($id)
    {

    }

    public function updateApply(Request $request)
    {

    }

    public function delete($id)
    {

    }
}
