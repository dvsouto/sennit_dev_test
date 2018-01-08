<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Api;

/**
 * AuthController
 *  Controller de autenticação do usuário
 * 
 * @author Davi Souto
 *         04/01/2018
 */
class AuthController extends Controller
{
    /**
     * Login na aplicação
     *
     * @author Davi Souto - 04/01/2018
     */
    public function login()
    {
        return view('authenticate.login');
    }

    /**
     * Logout na aplicação
     *
     * @author Davi Souto - 04/01/2018
     */
    public function logout()
    {
        session()->flush();

        return redirect()->route('auth.login');
    }

    ///////////////////////////////////////////////

    /**
     * Salvar token do usuário na sessão
     */
    public function Access($token)
    {
        // Apagar sessão atual
        if (session()->get('token'))
            session()->flush();

        // Recuperar dados da sessão
        $api = new Api();
        $session_data = $api->Token($token);

        if (! $session_data) throw new \Exception("Erro de sessão");
        else
        {
            // Salvar token e sessão
            session()->put('token', $token);
            session()->put('session_data', $session_data);
            // session()->save();

            return response()->json([ 'status' => 'success', 'code' => 1 ]);
        }

        return response()->json([ 'status' => 'error', 'code' => 2 ]);
    }
}
