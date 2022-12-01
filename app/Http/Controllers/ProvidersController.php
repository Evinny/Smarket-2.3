<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;


class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('providers.provider_register_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $motive = [

            'name' => 'required|min:3|max:100', 'address' => 'required|min:5|max:100',
            'size' => 'required', 'type' => 'required|max:80',
        ];

        $reason = [
            'name.required' => 'You need to have a Name as a Provider',
            'address.required' => 'Your Company is located on... Nowhere?',
            'size.required' => "We need to know how big is your Company",
            'type.required' => 'You need to inform what :attribute of Company you are',
            'min' => ':attribute is too small',
            'max' => ':attribute is too much, make it less',
            
        ];

        $request->validate($motive, $reason);


        $insert = Provider::create([
            'name' => $request->name,
            'address' => $request->address,
            'size' => $request->size,
            'type' => $request->type
        ]);



        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
