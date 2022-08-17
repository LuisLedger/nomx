<?php

namespace App\Http\Controllers;

use App\Models\ThemeSocial;
use Illuminate\Http\Request;

class ThemeSocialController extends Controller
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
        $menu_name = 'Sistema';

        if (\Request::ajax()) {

            $users = ThemeSocial::getThemeSocial($request);
            
            $this->content['status']    = 'success';
            $this->content['http_code'] = 200;
            $this->content['data']      = $users;

            return response()->json($this->content);
        }

        $columns = ThemeSocial::$columns;

        return view('admin.theme_social.index', compact('menu_name','columns'));
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
     * @param  \App\Models\ThemeSocial  $themeSocial
     * @return \Illuminate\Http\Response
     */
    public function show(ThemeSocial $themeSocial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ThemeSocial  $themeSocial
     * @return \Illuminate\Http\Response
     */
    public function edit(ThemeSocial $themeSocial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ThemeSocial  $themeSocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ThemeSocial $themeSocial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ThemeSocial  $themeSocial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ThemeSocial $themeSocial)
    {
        //
    }
}
