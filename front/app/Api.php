<?php

namespace App;

use GuzzleHttp\Client;
use Exception;

/**
 * Api
 *  Classe de requisição a API
 *
 * @author Davi Souto - 06/01/2018
 */
class Api
{
    /**
     * Retorna os dados da sessão buscando pelo token
     */
    public function Token($token)
    {
        return $this->request('GET', 'token/' . $token);
    }

    /**
     * Finaliza a sessão
     */
    public function TokenDelete($token)
    {
        return $this->request('DELETE', 'token/' . $token);
    }

    ////////////////////////////////////////////////

    /**
     * Efetuar uma requisição a API
     * 
     * @param string $type
     * @param string $route
     * @param array $params
     * @return Object
     */
    private function request($type, $route, $params = array())
    {
        $client = new Client([
            'base_uri'  =>  env('API_URL') . '/',
            'timeout'   =>  60
        ]);

        $request = $client->request(strtoupper($type), $route, $params);
        $data = json_decode($request->getBody()->getContents(), true);

        if (array_key_exists('data', $data))
            $data = $data['data'];

        return $data;
    }
}