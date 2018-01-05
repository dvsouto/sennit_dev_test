<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

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
        return redirect()->route('auth.login');
    }
}
