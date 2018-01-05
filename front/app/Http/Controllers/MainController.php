<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

/**
 * MainController
 * 
 * @author Davi Souto
 *         04/01/2018
 */
class MainController extends Controller
{
    /**
     * Rota inicial
     *
     * @author Davi Souto - 04/01/2018
     */
    public function default()
    {
        // Redirecionar para a página de login
        return redirect()->route('auth.login');
    }

    /**
     * Página principal
     *
     * @author Davi Souto - 04/01/2018
     */
    public function home()
    {
        return view('main.home');
    }
}
