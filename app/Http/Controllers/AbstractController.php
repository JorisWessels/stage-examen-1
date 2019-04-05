<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class AbstractController extends Controller
{
    protected $data = [];
    protected $validation;
    protected $fields;
    protected $name = 'dataNames';
    protected $singularName = 'dataName';

    /**
     * @param Collection $collection
     * @param string|null $name
     * @return array
     */
    protected function getAllItems(Collection $collection, string $name = null)
    {
        if (!is_null($name))
        {
            $this->data[$name] = $collection;
        }
        else {
            $this->data[$this->name] = $collection;
        }

        return ($this->data);
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function requestToArray($request)
    {
        $data = $request->except('_method', '_token','create', 'edit', 'password_confirm');

        return($data);
    }

    /**
     * @param Model $model
     * @return array
     */
    protected function getOneItem(Model $model)
    {
        $this->data[$this->singularName] = $model;

        return ($this->data);
    }

    /**
     * @param Model $model
     * @throws \Exception
     */
    protected function deleteItem(Model $model)
    {
        $model->delete();
    }
}
