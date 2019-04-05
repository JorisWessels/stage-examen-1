<?php

namespace App\Http\Controllers;

use App\Modelnames\ModelNames;
use App\Website;
use Illuminate\Http\Request;

class WebsiteController extends AbstractController
{
    public function __construct()
    {
        $this->validation = [
            'address_line' => 'required|max:255',
            'postal_code' => 'required|max:255',
            'city' => 'required|max:255',
            'country_code' => 'required|max:255',
            'vat_nr' => 'required_unless:nl_vat,0|max:255'
        ];
        $this->fields = [
            'id' => ModelNames::WEBSITE,
        ];

        $this->name = "dataNames";
        $this->singularName = "dataName";
        $this->data['content'] = ModelNames::WEBSITES;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->getAllItems(Company::all());
        $allFields = [];
        $extraFields = [
            [
                'name' => 'ID',
                'value' => 'id',
                'type' => 'text',
            ],
            [
                'name' => 'Company Name',
                'value' => 'name',
                'type' => 'text',
            ],
            [
                'name' => 'Address',
                'value' => 'address_line',
                'type' => 'text',
            ],
            [
                'name' => 'Dutch VAT number?',
                'value' => 'nl_vat',
                'type' => 'boolean',
            ],
            [
                'name' => 'VAT Number',
                'value' => 'vat_nr',
                'type' => 'text',
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        //
    }
}
