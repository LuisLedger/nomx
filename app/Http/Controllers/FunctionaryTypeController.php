<?php

namespace App\Http\Controllers;

use App\Models\FunctionaryType;
use Illuminate\Http\Request;

class FunctionaryTypeController extends Controller
{
    public function __construct() 
    {
        $this->content = [
            'status'    => 'error',
            'http_code' => 400,
            'message'   => '',
            'data'      => [],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $functionary_types = FunctionaryType::select();

        if (isset($request->level_id)) {
            $functionary_types = $functionary_types->where('level_id', $request->level_id);
        }

        $this->content['http_code'] = 200;
        $this->content['status'] = 'success';
        if (\Request::ajax()) {
            $functionary_types = $functionary_types->orderby('level_id','ASC')->get();
            $this->content['data'] = $functionary_types;
            return response()->json($this->content);
        }

        $functionary_types = $functionary_types->orderby('level_id','ASC')->paginate(10)->appends($request->all());

        // return view('admin.accounts.index');
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
     * @param  \App\Models\FunctionaryType  $functionaryType
     * @return \Illuminate\Http\Response
     */
    public function show(FunctionaryType $functionaryType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FunctionaryType  $functionaryType
     * @return \Illuminate\Http\Response
     */
    public function edit(FunctionaryType $functionaryType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FunctionaryType  $functionaryType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FunctionaryType $functionaryType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FunctionaryType  $functionaryType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FunctionaryType $functionaryType)
    {
        //
    }
}
