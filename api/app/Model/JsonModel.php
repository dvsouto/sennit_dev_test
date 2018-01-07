<?php

namespace App\Model;

use Storage;

/**
 * Model para trabalhar com os arquivos Json que armazena os dados da aplicação
 *
 * @author Davi Souto
 *         05/01/2018
 */
class JsonModel
{
    protected $file = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        if ($this->file)
        {
            $this->file = ucwords($this->file);
            $this->file .= ".json";
        }

        // Criar arquivo json caso não exista
        if (! Storage::disk('data')->exists($this->file))
            Storage::disk('data')->put($this->file, '{ }');
    }

    /**
     * Recuperar dados do Json e retornar uma collection
     *
     * @param string $name
     * @return collect
     */
    public function All()
    {
        $data = json_decode(Storage::disk('data')->get($this->file));
        $data = collect($data);

        return $data;
    }

    /**
     * Buscar item pelo ID
     *
     * @param string|int $id
     * @return collect|boolean
     */
    public function Find($id)
    {
        foreach($this->All() as $data_id => $data)
        {
            if ($id == $data_id)
                return $data;
        }

        return false;
    }

    /**
     * Adicionar item
     *
     * @param array $data
     * @param string|int $id
     * @return collect
     */
    public function Add($data, $id = false)
    {
        if (! $id)
        {
            $id = $this->getLastId();
            $id += 1;
        }

        $all_data = $this->All()->toArray();
        $all_data[$id] = $data;

        $this->save($all_data);

        return collect($data);
    }

    /**
     * Atualizar item
     *
     * @param string|int $id
     * @param array $fields
     * @return collect
     */
    public function Update($id, $fields)
    {
        $all_data = $this->All()->toArray();

        $data = false;
        $final = array();

        foreach($all_data as $key_data => $this_data)
        {
            $this_data = (array) $this_data;

            if ($key_data == $id)
            {
                foreach($fields as $k_field => $field)
                    $this_data[$k_field] = $field;

                $data = $this_data;
            }
            
            $final[$key_data] = $this_data;
        }

        $this->save($final);

        return collect($data);
    }

    /**
     * Deletar item
     *
     * @param string|int $id
     * @return collect
     */
    public function Delete($id)
    {
        $all_data = $this->All()->toArray();

        // if (array_key_exists($id, $all_data))
        // {
        //     $data = $all_data[$id];
        //     unset($all_data[$id]);
        // }
        $data = false;
        $final = array();

        foreach($all_data as $key_data => $this_data)
        {
            if ($key_data == $id) $data = $this_data;
            else $final[$key_data] = $this_data;
        }

        $this->save($final);

        return collect($data);
    }

    /**
     * Retorna o último ID
     */
    public function getLastId()
    {
        $last_key = $this->All()->keys()->last();

        if (! $last_key)
            $last_key = 0;

        return $last_key;
    }

    /////////////////////////////////////////////////////////////////////////////

    /**
     * Salvar dados
     *
     * @param array/collect $data
     * @return bool
     */
    private function save($data)
    {
        try
        {
            // Verificar se é uma collection e transformar em array
            if ($data instanceof \Illuminate\Database\Eloquent\Collection)
                $data = $data->toArray();

            $data = json_encode($data, JSON_PRETTY_PRINT);

            Storage::disk('data')->put($this->file, $data);
        } catch (Exception $e)
        {
            return false;
        }

        return true;

    }
}