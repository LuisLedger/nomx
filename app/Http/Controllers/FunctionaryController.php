<?php

namespace App\Http\Controllers;

use App\Models\Functionary;
use Illuminate\Http\Request;

class FunctionaryController extends Controller
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
        $functionaries = Functionary::getFunctionaries($request);

        $this->content['http_code'] = 200;
        $this->content['status'] = 'success';
        if (\Request::ajax()) {
            $this->content['data'] = $functionaries
                ->orderBy('first_name','ASC')
                ->orderBy('last_name','ASC')
                ->paginate($request->limit)->appends($request->all());
            return response()->json($this->content);
        }

        $functionaries = $functionaries->paginate(10)->appends($request->all());

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
     * @param  \App\Models\Functionary  $functionary
     * @return \Illuminate\Http\Response
     */
    public function show(Functionary $functionary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Functionary  $functionary
     * @return \Illuminate\Http\Response
     */
    public function edit(Functionary $functionary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Functionary  $functionary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Functionary $functionary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Functionary  $functionary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Functionary $functionary)
    {
        //
    }
}
