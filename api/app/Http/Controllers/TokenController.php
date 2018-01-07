<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\UsuarioModel;
use App\Model\TokenModel;
use App\IResponse;


/**
 * TokenController
 *  Controller de autenticação do usuário por token
 * 
 * @author Davi Souto
 *         04/01/2018
 */
class TokenController extends Controller
{
    /**
     * Criar token
     *
     * @author Davi Souto - 05/01/2018
     */
    public function createToken(Request $request)
    {
        IResponse::Validate($request, [
            'usuario' => 'required|string',
            'senha' => 'required|string',
        ]);

        $usuarioModel = new UsuarioModel();
        $usuarios = $usuarioModel->All();

        foreach($usuarios as $usuario)
        {
            // Usuário e senha corretos
            if ($usuario->usuario == $request->get('usuario') && $usuario->senha == $request->get('senha'))
            {
                $tokenModel = new TokenModel();
                $allTokens = $tokenModel->All();

                // Apagar tokens antigos
                foreach($allTokens as $id_token => $this_token)
                {
                    if ($this_token->usuario == $usuario->usuario)
                        $tokenModel->Delete($id_token);
                }

                // Gerar token
                $token = md5(uniqid(rand(), true));
                $tokenModel->add([
                    'usuario'   =>  $usuario->usuario,
                    'expiracao' =>  date('Y-m-d H:i:s', strtotime('+1 hour'))
                ], $token);

                return IResponse::setCode(1)->setStatus('success')->setData($token)->getResponse(200);
            }
        }

        // Não autorizado
        return IResponse::setCode('2.1')->setStatus('error')->getResponse(401);
    }

    /**
     * Remover token
     *
     * @author Davi Souto - 05/01/2018
     */
    public function deleteToken($token)
    {
        $tokenModel = new TokenModel();
        $find_token = $tokenModel->Find($token);

        if ($find_token)
        {
            $tokenModel->Delete($token);

            return IResponse::setCode(1)->setStatus('success')->getResponse(200);
        } else return IResponse::setCode('2.2')->setStatus('error')->getResponse(200);
    }

    /**
     * Retorna os dados da sessão
     */
    public function getToken($token)
    {
        $tokenModel = new TokenModel();
        $find_token = $tokenModel->Find($token);

        if ($find_token)
        {
            $expiracao = $find_token->expiracao;
            $now = date('Y-m-d H:i:s');

            // Verificar se expirou
            if (strtotime($now) > strtotime($expiracao))
            {
                $tokenModel->Delete($token);
                return IResponse::setCode('2.3')->setStatus('error')->getResponse(200);
            } else return IResponse::setCode(1)->setStatus('success')->setData($find_token)->getResponse(200);
        } else return IResponse::setCode('2.3')->setStatus('error')->getResponse(200);
    }
}
