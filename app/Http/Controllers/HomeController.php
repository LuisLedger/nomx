<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Functionary;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    public function functionary(Request $request, $id) 
    {
        if (empty($id)) {
            return redirect()->back();
        }

        if (!is_numeric($id)) {
            return redirect()->back();
        }

        $functionary = Functionary::find($id);

        return view('functionary_details',compact('functionary'));
    }
}
