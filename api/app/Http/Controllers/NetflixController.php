<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\IResponse;
use GuzzleHttp\Client;

use Exception;

/**
 * NetflixController
 *  Devido as requisiçōes ajax a links externos serem bloqueadas por segurança, foi necessário efetuar as
 *  requisiçōes a Netflix Roulette API pelo servidor.
 * 
 * @author Davi Souto
 *         07/01/2018
 */
class NetflixController extends Controller
{
    /**
     * Retornar um filme/série aleatório
     *
     * @author Davi Souto - 07/01/2018
     */
    public function Roll(Request $request)
    {
        IResponse::Validate($request, [
            'score_minimo'  => 'int',
            'genero'        => 'int',
            'tipo'          => 'string'
        ]);

        $client = new Client([
            'base_uri'  =>  env('NETFLIX_API') . '/',
            'timeout'   =>  60
        ]);

        $kind = 0;
        $minimumScore = 4;
        $genre = false;

        // Filtrar por tipo (série ou filme)
        if ($request->exists('tipo'))
        {
            switch (strtolower($request->get('tipo')))
            {
                case 'todos':  $kind = 0; break;
                case 'series': $kind = 1; break;
                case 'filmes': $kind = 2; break;
            }
        }

        // Filtrar por avaliação no IMDB
        if ($request->exists('score_minimo'))
        {
            $minimumScore = $request->get('score_minimo');

            if ($minimumScore < 4) $minimumScore = 4;
            if ($minimumScore > 9) $minimumScore = 9;
        }

        // Filtrar por gênero
        if ($request->exists('genero'))
        {
            $genre = $request->get('genero');

            if ($genre < 0) $genre = false;
            if ($genre > 28) $genre = 28;
        }

        try
        {
            // Tentar até 3 vezes buscar um filme
            $retry = 3;

            $params = array(
                'nocache'   =>  true,
                'kind'      =>  $kind,
                'minimumScore'  =>  $minimumScore
            );

            if ($genre)
                $params['genre'] = $genre;

            while($retry > 0)
            {
                $retry--;

                $data = $client->request('GET', '/roulette/netflix', [
                    'query' =>  $params
                ]);

                // Essa requisição retorna o id do filme
                $data = json_decode($data->getBody()->getContents(), true);

                if (array_key_exists('id', $data))
                {
                    $content_type = strtolower($data['content_type']);

                    if ($content_type == 'm') $content_type = 'movie';
                    else if ($content_type = 's') $content_type = 'show';

                    // Já essa requisição retorna os dados do filme
                    $movie_data = $client->request('GET', "/{$content_type}/" . $data['id']);
                    $movie_data = json_decode($movie_data->getBody()->getContents(), true);


                    if (! empty($movie_data) && is_array($movie_data))
                    {
                        // Adicionar url da imagem
                        $movie_data['image'] = "https://img.reelgood.com/content/{$content_type}/" . $data['id'] . "/poster-780.jpg";

                        return IResponse::setCode(1)->setStatus('success')->setData($movie_data)->getResponse(200);
                    }
                }

                sleep(1);
            }

            throw new Exception("Ocorreu um erro");
        } catch(Exception $e){ throw $e;
            return IResponse::setCode('4.1')->setStatus('error')->getResponse(200); 
        }
    }
}
