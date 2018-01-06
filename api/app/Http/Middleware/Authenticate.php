<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use App\Model\TokenModel;
use App\IResponse;
use Exception;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Recebe os parametros da rota
        // $params = (object) $request->route()->parameters();

        // Parâmetros do header
        $params = $request->headers->all();

        if (is_array($params))
            $params = array_change_key_case($params, CASE_LOWER);

        try 
        {
            if (! array_key_exists('x-auth-token', $params))
                throw new Exception('Token não informado');

            $tokenModel = new TokenModel();
            $token_find = $tokenModel->find($params['x-auth-token'][0]);

            if ($token_find)
            {
                $expiracao = $token_find->expiracao;
                $now = date('Y-m-d H:i:s');

                // Verificar se expirou
                if (strtotime($now) > strtotime($expiracao))
                {
                    $tokenModel->Delete($token);
                    return IResponse::setCode('2.3')->setStatus('error')->getResponse(401);
                }

                return $next($request);
            }
            else return IResponse::setCode('2.3')->setStatus('error')->getResponse(401);
        } catch(\Exception $e) {
            // abort(401);
            return IResponse::setCode('401')->setStatus('error')->getResponse(401);
        }

        // Não autorizado
        return IResponse::setCode('401')->setStatus('error')->getResponse(401);
    }
}
