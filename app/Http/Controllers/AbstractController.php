<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbstractController extends Controller
{
    protected $data = [];
    protected $validation;
    protected $fields;
    protected $name = null;
    protected $singularName = null;

    function getAllItems()
    {

    }
}
