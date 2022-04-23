<?php

namespace App\Http\Controllers;

use App\Models\Delegation;
use Illuminate\Http\Request;

class DelegationController extends Controller
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
    public function index(Request $request, $id)
    {
        $delegations = Delegation::select();

        if (!empty($id)) {
            $delegations = $delegations->where('state_id', $id);
        }

        $this->content['http_code'] = 200;
        $this->content['status'] = 'success';
        if (\Request::ajax()) {
            $delegations = $delegations->get();
            $this->content['data'] = $delegations;
            return response()->json($this->content);
        }

        $delegations = $delegations->paginate(10)->appends($request->all());

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
     * @param  \App\Models\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function show(Delegation $delegation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function edit(Delegation $delegation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delegation $delegation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delegation $delegation)
    {
        //
    }
}
