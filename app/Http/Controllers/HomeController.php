<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Functionary;
use App\Models\FunctionaryActivity;
use App\Models\Project;
use App\Models\Law;
use App\Models\Proposal;

class HomeController extends Controller
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
    public function index()
    {
        return view('welcome');
    }

    public function search(Request $request) 
    {
        
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

    public function themes()
    {
        return view('important_themes');
    }

    public function functionary_activities(Request $request, $id)
    {
        $functionary_activities = FunctionaryActivity::select();

        if (empty($id)) {
            return redirect()->back();
        }

        if (!is_numeric($id)) {
            return redirect()->back();
        }

        $functionary_activities = $functionary_activities->where('functionary_id', $id);

        $this->content['http_code'] = 200;
        $this->content['status'] = 'success';

        $this->content['data'] = $functionary_activities->orderBy('created_at','DESC')->paginate($request->limit)->appends($request->all());


        return response()->json($this->content);
    }

    public function functionary_projects(Request $request, $id)
    {
        $functionary_activities = Project::select();

        if (empty($id)) {
            return redirect()->back();
        }

        if (!is_numeric($id)) {
            return redirect()->back();
        }

        $functionary_activities = $functionary_activities->where('promote_functionary_id', $id);

        $this->content['http_code'] = 200;
        $this->content['status'] = 'success';

        $this->content['data'] = $functionary_activities->orderBy('created_at','DESC')->paginate($request->limit)->appends($request->all());


        return response()->json($this->content);
    }

    public function functionary_laws(Request $request, $id)
    {
        $functionary_laws = Law::select();

        if (empty($id)) {
            return redirect()->back();
        }

        if (!is_numeric($id)) {
            return redirect()->back();
        }

        $functionary_laws = $functionary_laws->where('promote_functionary_id', $id);

        $this->content['http_code'] = 200;
        $this->content['status'] = 'success';

        $this->content['data'] = $functionary_laws->orderBy('created_at','DESC')->paginate($request->limit)->appends($request->all());


        return response()->json($this->content);
    }

    public function functionary_proposals(Request $request, $id)
    {
        $proposals = Proposal::select();

        if (empty($id)) {
            return redirect()->back();
        }

        if (!is_numeric($id)) {
            return redirect()->back();
        }

        $proposals = $proposals->where('promote_functionary_id', $id);

        $this->content['http_code'] = 200;
        $this->content['status'] = 'success';

        $this->content['data'] = $proposals->orderBy('created_at','DESC')->paginate($request->limit)->appends($request->all());


        return response()->json($this->content);
    }
}
