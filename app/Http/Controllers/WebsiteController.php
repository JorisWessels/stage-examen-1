<?php

namespace App\Http\Controllers;

use App\Modelnames\ModelNames;
use App\User;
use App\Vasttag;
use App\Website;
use App\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebsiteController extends AbstractController
{
    public function __construct()
    {
        $this->validation = [
            'user_id' => 'required',
        ];

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
        $extraValidation = [
            'name' => 'required|unique:websites|max:255',
            'url' => 'required|unique:websites|url|max:255'];

        $this->validation = array_merge($this->validation, $extraValidation);
        $request->validate($this->validation);

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
        $website = Website::all()->where("user_id", "=", $id);

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
        $extraValidation = [
            'name' => 'required|unique:websites,name,' . $id . '|max:255',
            'url' => 'required|unique:websites,url,' . $id . '|url|max:255'];

        $this->validation = array_merge($this->validation, $extraValidation);
        $request->validate($this->validation);

        $data = $this->requestToArray($request);
        Website::whereId($id)->update($data);
        return redirect()->action('WebsiteController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return void
     * @throws \Exception
     */

    public function destroy($id)
    {
        Website::where('id', $id)->update(['deleted_at' => Carbon::now()]);
        $zones = Zone::where('website_id', $id)->get();
        foreach ($zones as $zone) {
            Vasttag::where('zone_id', $zone->id)->delete();
        }
        Zone::where('website_id', $id)->delete();

        return redirect()->action('WebsiteController@index');
    }
}
