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
     * Recuperar pessoa
     *
     * @author Davi Souto - 07/01/2018
     */
    public function Get($id)
    {
        $pessoaModel = new PessoaModel();
        $pessoa = $pessoaModel->find($id);

        if (! $pessoa)
            return IResponse::setCode('3.1')->setStatus('error')->getResponse(200);

        return IResponse::setCode(1)->setStatus('success')->setData($pessoa)->getResponse(200);
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
    public function Update(Request $request, $id)
    {
        IResponse::Validate($request, [
            'nome'  =>  'string',
            'email' =>  'string'
        ]);

        $pessoaModel = new PessoaModel();
        $pessoa = $pessoaModel->find($id);

        if (! $pessoa)
            return IResponse::setCode('3.1')->setStatus('error')->getResponse(200);

        $fields = array();

        if ($request->exists('nome'))
            $fields['nome'] = $request->get('nome');

        if ($request->exists('email'))
            $fields['email'] = $request->get('email');

        $pessoa = $pessoaModel->Update($id, $fields);

        return IResponse::setCode(1)->setStatus('success')->setData($pessoa)->getResponse(200);
    }

    /**
     * Remover pessoa
     *
     * @author Davi Souto - 05/01/2018
     */
    public function Delete($id)
    {
        $pessoaModel = new PessoaModel();
        $pessoa = $pessoaModel->find($id);

        if (! $pessoa)
            return IResponse::setCode('3.1')->setStatus('error')->getResponse(200);

        $pessoaModel->Delete($id);

        return IResponse::setCode(1)->setStatus('success')->setData($pessoa)->getResponse(200);
    }
}
