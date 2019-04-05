<?php

namespace App\Http\Controllers;

use App\Modelnames\ModelNames;
use App\User;
use Illuminate\Http\Request;

class UserController extends AbstractController
{
    public function __construct()
    {
        $this->fields = [
            'id' => ModelNames::USER,
        ];

        $this->data['content'] = ModelNames::USERS;
        $this->data['route'] = ModelNames::USER;
        $this->data['onlyShow'] = 'data';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->getAllItems(User::all());
        $allFields = [];
        $extraFields = [
            [
                'name' => 'ID',
                'value' => 'id',
                'type' => 'text',
            ],
            [
                'name' => 'Name',
                'value' => 'name',
                'type' => 'text',
            ],
            [
                'name' => 'Email',
                'value' => 'email',
                'type' => 'text',
            ],
        ];

        foreach ($extraFields as $field) {
            $allFields[] = array_merge($this->fields, $field);
        }
        $this->data['tablefields'] = $allFields;
        return view('content.index', $this->data);
    }
}
