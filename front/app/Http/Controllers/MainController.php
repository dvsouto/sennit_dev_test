<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        // Redirecionar para a página de login ou para página inicial
        if (session()->get('token')) return redirect()->route('project.home');
        else return redirect()->route('auth.login');
    }

    /**
     * Documentação da API
     */
    public function api_documentation()
    {
        return view('swagger-ui.view');
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
