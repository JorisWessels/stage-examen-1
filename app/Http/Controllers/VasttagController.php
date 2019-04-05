<?php

namespace App\Http\Controllers;

use App\Modelnames\ModelNames;
use App\Vasttag;
use App\Zone;
use Illuminate\Http\Request;

class VasttagController extends AbstractController
{
    public function __construct()
    {
        $this->validation = [
            'zone_id' => 'required',
        ];

        $this->fields = [
            'id' => ModelNames::VASTTAG,
        ];

        $this->data['content'] = ModelNames::VASTTAGS;
        $this->data['route'] = ModelNames::VASTTAG;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->getAllItems(Vasttag::all());
        $allFields = [];
        $extraFields = [
            [
                'name' => 'ID',
                'value' => 'id',
                'type' => 'text',
            ],
            [
                'name' => 'Provider',
                'value' => 'provider_name',
                'type' => 'text',
            ],
            [
                'name' => 'Url',
                'value' => 'url',
                'type' => 'text',
            ],
            [
                'name' => 'Zone',
                'value' => 'div_tag',
                'type' => 'text',
                'relation' => 'zone',
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
                'name' => 'provider_name',
                'label' => 'Provider Name',
                'type' => 'text',
            ],
            [
                'name' => 'url',
                'label' => 'Url',
                'type' => 'text',
            ],
            [
                'name' => 'zone_id',
                'label' => 'Zone',
                'type' => 'dropdown',
                'data' => Zone::all(),
                'key' => 'div_tag',
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
        $extraValidation = [
            'provider_name' => 'required|unique:vasttags|max:255',
            'url' => 'required|unique:vasttags|url|max:255'];

        $this->validation = array_merge($this->validation, $extraValidation);
        $request->validate($this->validation);

        $data = $this->requestToArray($request);
        Vasttag::insert($data);
        return redirect()->action('VasttagController@index');
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
        $this->getOneItem(Vasttag::find($id));

        $categoryFields ['details'] = [
            [
                'name' => 'id',
                'label' => 'ID',
                'type' => 'text',
                'value' => 'id',
            ],
            [
                'name' => 'provider_name',
                'label' => 'Name',
                'value' => 'provider_name',
                'type' => 'text',
            ],
            [
                'name' => 'url',
                'label' => 'Url',
                'value' => 'url',
                'type' => 'text',
            ],
            [
                'name' => 'zone_id',
                'label' => 'Zone',
                'value' => 'div_tag',
                'type' => 'text',
                'relation' => 'zone',
            ],
        ];

        foreach ($categoryFields as & $categoryField) {
            foreach ($categoryField as $key => $field) {
                $categoryField [$key] = array_merge($field, $this->fields);
            }
        }

        $category [] = [
            'title' => 'Vasttag Details',
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
        $this->getOneItem(Vasttag::find($id));
        $allFields = [];
        $extraFields = [
            [
                'name' => 'provider_name',
                'label' => 'Provider Name',
                'type' => 'text',
                'value' => 'provider_name',
            ],
            [
                'name' => 'url',
                'label' => 'Url',
                'type' => 'text',
                'value' => 'url',
            ],
            [
                'name' => 'zone_id',
                'label' => 'Zone',
                'type' => 'dropdown',
                'data' => Zone::all(),
                'key' => 'div_tag',
                'value' => 'zone_id',
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
        $extraValidation = [
            'provider_name' => 'required|unique:vasttags,provider_name,' . $id . '|max:255',
            'url' => 'required|unique:websites,url,' . $id . '|url|max:255'];

        $this->validation = array_merge($this->validation, $extraValidation);
        $request->validate($this->validation);

        $data = $this->requestToArray($request);
        Vasttag::whereId($id)->update($data);
        return redirect()->action('VasttagController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->deleteItem(Vasttag::find($id));
        return redirect()->action('VasttagController@index');
    }
}
