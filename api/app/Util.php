<?php

namespace App;

use Storage;

/**
 * Classe Util
 *
 * @author Davi Souto
 *         05/01/2018
 */
class JsonData
{
    /**
     * Recuperar dados do Json e retornar uma collection
     *
     * @param string $name
     * @return Collection
     */
    public static function All($name)
    {
        $name = ucfirst($name);
        $name .= ".json";

        $data = json_decode(Storage::disk('data')->get('Usuario.json'));
        $data = collect($data);

        return $data;
    }

    public static function Find()
    {

    }

    public static function Add()
    {

    }

    public static function Delete()
    {
        
    }
}