<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;

class PessoaController extends Controller
{

    public function index()
    {
        return Pessoa::all();
    }


    public function store(Request $request)
    {
        $dados = $request->all();
        return Pessoa::create($dados);
    }

    public function update(Request $request, $id)
    {
        $pessoa = Pessoa::findOrFail($id);
        if($pessoa->update($request->all())){
            return $pessoa;
        }else{
            return "error";
        }

    }

    public function destroy($id)
    {
        $pessoa = Pessoa::findOrFail($id);
        return $pessoa->destroy($id);
    }
}
