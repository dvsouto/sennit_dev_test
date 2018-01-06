<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\PessoaModel;
use App\IResponse;


/**
 * PessoaController
 * 
 * @author Davi Souto
 *         05/01/2018
 */
class PessoaController extends Controller
{
    /**
     * Listar pessoas
     *
     * @author Davi Souto - 05/01/2018
     */
    public function List(Request $request)
    {
        $pessoaModel = new PessoaModel();
        $pessoas = $pessoaModel->All();

        return IResponse::setCode(1)->setStatus('success')->setData($pessoas)->getResponse(200);
    }

    /**
     * Criar pessoa
     *
     * @author Davi Souto - 05/01/2018
     */
    public function Create(Request $request)
    {
        IResponse::Validate($request, [
            'nome' => 'required|string',
            'email' => 'required|string',
        ]);

        $pessoaModel = new PessoaModel();
        $pessoa = $pessoaModel->Add([
            'nome'  =>  $request->get('nome'),
            'email' =>  $request->get('email')
        ]);

        return IResponse::setCode(1)->setStatus('success')->setData($pessoa)->getResponse(200);
    }

    /**
     * Atualizar pessoa
     *
     * @author Davi Souto - 05/01/2018
     */
    public function Update(Request $request)
    {
        $pessoaModel = new PessoaModel();
    }

    /**
     * Remover pessoa
     *
     * @author Davi Souto - 05/01/2018
     */
    public function Delete(Request $request)
    {
        $pessoaModel = new PessoaModel();
    }
}
