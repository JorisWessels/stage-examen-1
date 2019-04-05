<?php

namespace App\Http\Controllers;

use App\Modelnames\ModelNames;
use App\Website;
use App\Zone;
use Illuminate\Http\Request;

class ZoneController extends AbstractController
{
    public function __construct()
    {
        $this->fields = [
            'id' => ModelNames::ZONE,
        ];

        $this->data['content'] = ModelNames::ZONES;
        $this->data['route'] = ModelNames::ZONE;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getAllItems(Zone::all());
        $allFields = [];
        $extraFields = [
            [
                'name' => 'ID',
                'value' => 'id',
                'type' => 'text',
            ],
            [
                'name' => 'Div Tag',
                'value' => 'div_tag',
                'type' => 'text',
            ],
            [
                'name' => 'Website',
                'value' => 'url',
                'type' => 'text',
                'relation' => 'website',
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
                'name' => 'div_tag',
                'label' => 'Div Tag',
                'type' => 'text',
            ],
            [
                'name' => 'website_id',
                'label' => 'Website',
                'type' => 'dropdown',
                'data' => Website::all(),
                'key' => 'url',
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->requestToArray($request);
        Zone::insert($data);
        return redirect()->action('ZoneController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = [];
        $categoryFields = [];
        $this->getOneItem(Zone::find($id));

        $categoryFields ['details'] = [
            [
                'name' => 'id',
                'label' => 'ID',
                'type' => 'text',
                'value' => 'id',
            ],
            [
                'name' => 'div_tag',
                'label' => 'Div Tag',
                'value' => 'div_tag',
                'type' => 'text',
            ],
            [
                'name' => 'website_id',
                'label' => 'Website',
                'value' => 'url',
                'type' => 'text',
                'relation' => 'website',
            ],
        ];

        foreach ($categoryFields as & $categoryField) {
            foreach ($categoryField as $key => $field) {
                $categoryField [$key] = array_merge($field, $this->fields);
            }
        }

        $category [] = [
            'title' => 'Zone Details',
            'fields' => $categoryFields['details'],
        ];

        $this->data['categories'] = $category;
        return view('content.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->getOneItem(Zone::find($id));
        $allFields = [];
        $extraFields = [
            [
                'name' => 'div_tag',
                'label' => 'Div Tag',
                'type' => 'text',
                'value' => 'div_tag',
            ],
            [
                'name' => 'website_id',
                'label' => 'Website',
                'type' => 'dropdown',
                'data' => Website::all(),
                'key' => 'url',
                'value' => 'website_id',
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->requestToArray($request);
        Zone::whereId($id)->update($data);
        return redirect()->action('ZoneController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleteItem(Zone::find($id));
        return redirect()->action('ZoneController@index');
    }
}
