<?php

namespace App;

use Illuminate\Http\Request;
use Validator;

/**
 * Classe padrão para retorno da API
 */
class IResponse
{
    private $message = '';
    private $status = 'success';
    private $data = [];
    private $code = 1;
    private $exception = false;

    public static function __callStatic($name, $params)
    {
        $class = new self();

        return call_user_func_array([$class, $name], $params);
    }

    public function __call($name, $params)
    {
        return call_user_func_array([$this, $name], $params);
    }

    private function setStatus($status = 'success')
    {
        $this->status = $status;

        return $this;
    }

    private function setData($data = [], $clear = true)
    {
        if (! is_array($data))
        {
            if ($data instanceof \Illuminate\Database\Eloquent\Collection || is_a($data, 'Illuminate\Support\Collection')) // Collection
            {
                $data = $data->toArray();
            } else if (is_object($data))
            {
                if (is_subclass_of($data, 'Illuminate\Database\Eloquent\Model')) $data = $data->toArray(); // Model
                else $data = (array) $data; // Objeto
            }
        }

        $this->data = ($clear) ? $data : array_merge($this->data, $data);

        return $this;
    }

    private function setCode($code, $params = [], $translate = true)
    {
        $this->code     = $code;

        if ($translate) $this->message = trans('response.' . str_replace('.', '_', $code), $params);
        else if (! is_array($params)) $this->message = ucfirst($params);

        return $this;
    }

    private function getResponse($response = 200)
    {
        return response()->json([
            'status'    => trans('response.' . $this->status),
            'message'   => $this->message,
            'data'      => $this->data,
            'code'      => $this->code,
        ], $response, [], JSON_PRETTY_PRINT)
            ->header('charset', 'utf-8');
    }

    /////////////////////////////////////////////////////

    /**
     * Método padrão de validação dos parâmetros de entrada
     *
     * @param Request $request
     * @param string[] $arr_validate
     */
    private function Validate(Request $request, $arr_validate, $httpcode_exception = 400)
    {
        if (empty($arr_validate)) return true;
        if (! is_array($arr_validate)) $arr_validate = array($arr_validate);

        $params = $request->all();

        foreach($params as &$param)
        {
            if (is_string($param))
            {
                if ($param === 'true') $param = true;
                else if ($param === 'false') $param = false;
            }
        }

        $validate = Validator::make($params, $arr_validate);

        if ($validate->fails()) {
            // $erro = array_keys($validate->errors()->toArray());
            // $erro = $erro[0];

            $erro = $validate->errors()->first();

            return $this->setStatus('error')->setCode(2.1, $erro, false)->getResponse($httpcode_exception)->throwResponse();
        }

        return true;
    }
}