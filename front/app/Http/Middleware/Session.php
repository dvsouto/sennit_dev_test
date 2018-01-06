<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use \App\Api;

/**
 * Session Middleware
 *  Verificart
 */
class Session
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try
        {
            $token = session()->get('token'); // Recuperar token
            if (! $token) throw new \Exception('Session not found'); // Verificar se existe sessão
            else
            {
                // Recuperar sessão pelo token
                $api = new Api();
                $session_data = $api->Token($token);

                // Verificar se a sessão é valida ou expirou
                if (! $session_data)
                {
                    // if ($session_data->code == '2.2' || $session_data->code == '2.3')
                    session()->flush();

                    throw new \Exception('Session expired');
                } else
                {
                    // Atualizar sessão
                    session()->put('session_data', $session_data);
                }
            }
        } catch(\Exception $e)
        {
            // Redirecionar para a página de login
            return redirect()->route('auth.login');
        }

        return $next($request);
    }
}
