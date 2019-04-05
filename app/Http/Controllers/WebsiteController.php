<?php

namespace App\Http\Controllers;

use App\Modelnames\ModelNames;
use App\User;
use App\Website;
use Illuminate\Http\Request;

class WebsiteController extends AbstractController
{
    public function __construct()
    {
        $this->fields = [
            'id' => ModelNames::WEBSITE,
        ];

        $this->data['content'] = ModelNames::WEBSITES;
        $this->data['route'] = ModelNames::WEBSITE;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->getAllItems(Website::all());
        $allFields = [];
        $extraFields = [
            [
                'name' => 'ID',
                'value' => 'id',
                'type' => 'text',
            ],
            [
                'name' => 'Website',
                'value' => 'name',
                'type' => 'text',
            ],
            [
                'name' => 'User',
                'value' => 'name',
                'type' => 'text',
                'relation' => 'user',
            ],
            [
                'name' => 'Active',
                'value' => 'active',
                'type' => 'boolean',
            ],
        ];

        foreach ($extraFields as $field) {
            $allFields[] = array_merge($this->fields, $field);
        }
        $this->data['tablefields'] = $allFields;
        return view('content.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allFields = [];
        $extraFields = [
            [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
            ],
            [
                'name' => 'url',
                'label' => 'Url',
                'type' => 'text',
            ],
            [
                'name' => 'user_id',
                'label' => 'User',
                'type' => 'dropdown',
                'data' => User::all(),
                'key' => 'name',
            ],
            [
                'name' => 'active',
                'label' => 'Active',
                'type' => 'checkbox',
            ],
        ];

        foreach ($extraFields as $field) {
            $allFields[] = array_merge($this->fields, $field);
        }
        $this->data['inputfields'] = $allFields;
        return view('content.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->requestToArray($request);
        Website::insert($data);
        return redirect()->action('WebsiteController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = [];
        $categoryFields = [];
        $this->getOneItem(Website::find($id));

        $categoryFields ['details'] = [
            [
                'name' => 'id',
                'label' => 'ID',
                'type' => 'text',
                'value' => 'id',
            ],
            [
                'name' => 'name',
                'label' => 'Name',
                'value' => 'name',
                'type' => 'text',
            ],
            [
                'name' => 'url',
                'label' => 'Url',
                'value' => 'url',
                'type' => 'text',
            ],
            [
                'name' => 'user',
                'label' => 'User',
                'value' => 'name',
                'type' => 'text',
                'relation' => 'user',
            ],
            [
                'name' => 'active',
                'label' => 'Active',
                'value' => 'active',
                'type' => 'boolean',
            ],
        ];

        foreach ($categoryFields as & $categoryField) {
            foreach ($categoryField as $key => $field) {
                $categoryField [$key] = array_merge($field, $this->fields);
            }
        }

        $category [] = [
            'title' => 'Website Details',
            'fields' => $categoryFields['details'],
        ];

        $this->data['categories'] = $category;
        return view('content.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->getOneItem(Website::find($id));
        $allFields = [];
        $extraFields = [
            [
                'name' => 'name',
                'label' => 'Name',
                'type' => 'text',
                'value' => 'name',
            ],
            [
                'name' => 'url',
                'label' => 'Url',
                'type' => 'text',
                'value' => 'url',
            ],
            [
                'name' => 'user_id',
                'label' => 'User',
                'type' => 'dropdown',
                'data' => User::all(),
                'key' => 'name',
                'value' => 'user_id',
            ],
            [
                'name' => 'active',
                'label' => 'Active',
                'type' => 'checkbox',
                'value' => 'active',
            ],
        ];

        foreach ($extraFields as $field) {
            $allFields[] = array_merge($this->fields, $field);
        }
        $this->data['inputfields'] = $allFields;
        return view('content.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->requestToArray($request);
        Website::whereId($id)->update($data);
        return redirect()->action('WebsiteController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     */

    public function destroy($id)
    {
        $this->deleteItem(Website::find($id));
        return redirect()->action('WebsiteController@index');
    }
}
