<?php

namespace App\Http\Controllers;

use App\Models\Functionary;
use App\Models\FunctionaryActivity;
use App\Models\FunctionaryPeriod;
use App\Models\Law;
use App\Models\Period;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\PoliticGroup;
use App\Models\ScheduleSession;
use Illuminate\Http\Request;

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
        $menu = 'home';
        return view('principal',compact('menu'));
    }

    public function find_functionaries(Request $request)
    {
        $menu = 'find_functionaries';
        return view('find_functionaries',compact('menu'));
    }

    public function chamber_dips(Request $request)
    {
        $menu = 'chamber_dips';
        return view('chamber_dips',compact('menu'));
    }

    public function chamber_sens(Request $request)
    {
        $menu = 'chamber_sens';
        return view('chamber_sens',compact('menu'));
    }

    public function functionary(Request $request, $id)
    {
        if (empty($id)) {
            return redirect()->back();
        }

        if (!is_numeric($id)) {
            return redirect()->back();
        }

        $menu = 'functionary_details';
        $functionary = Functionary::find($id);

        return view('functionary_details', compact('functionary','menu'));
    }

    public function themes()
    {
        $menu = 'themes';
        return view('important_themes',compact('menu'));
    }

    public function functionary_cameras(Request $request)
    {
        $chunk = 125;
        $functionaries = Functionary::select();
        $schedule      = ScheduleSession::where('session_date',date('Y-m-d'));

        if (isset($request->level_id)) {
            $chunk = ($request->level_id != 1)?14:$chunk;
            $functionaries = $functionaries->where('level_id', $request->level_id);
            $schedule = $schedule->where('level_id', $request->level_id);
        } else {
            $functionaries = $functionaries->where('level_id', 1);
            $schedule = $schedule->where('level_id', 1);
        }

        if (isset($request->functionary_type_id)) {
            $schedule = $schedule->where('level_id', $request->functionary_type_id);
            $functionaries = $functionaries->where('functionary_type_id', $request->functionary_type_id);
        } else {
            $schedule = $schedule->where('level_id', 4);
            $functionaries = $functionaries->where('functionary_type_id', 4);
        }

        if (isset($request->politic_group_id)) {
            $functionaries = $functionaries->where('politic_group_id', $request->politic_group_id);
        }

        if (isset($request->period_id)) {
            $functionary_period = FunctionaryPeriod::select('functionary_id')->where('period_id', $request->period_id)->get()->toArray();

            $functionaries = $functionaries->whereIn('id', $functionary_period);
        }

        if (isset($request->state_id)) {
            $schedule = $schedule->where('state_id', $request->state_id);
            $functionaries = $functionaries->where('state_id', $request->state_id);
        }

        $functionaries = $functionaries->orderBy('first_name','ASC')->orderby('middle_name', 'ASC')->orderBy('last_name','ASC')->get()->toArray();
        $schedule = $schedule->first();
        
        $this->content['http_code'] = 200;
        $this->content['status']    = 'success';

        $this->content['data'] = [
            'schedule'      => $schedule,
            'functionaries' => array_chunk($functionaries, $chunk,true)
        ];

        return response()->json($this->content);
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
        $this->content['status']    = 'success';

        $this->content['data'] = $functionary_activities->orderBy('created_at', 'DESC')->paginate($request->limit)->appends($request->all());

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
        $this->content['status']    = 'success';

        $this->content['data'] = $functionary_activities->orderBy('created_at', 'DESC')->paginate($request->limit)->appends($request->all());

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
        $this->content['status']    = 'success';

        $this->content['data'] = $functionary_laws->orderBy('created_at', 'DESC')->paginate($request->limit)->appends($request->all());

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
        $this->content['status']    = 'success';

        $this->content['data'] = $proposals->orderBy('created_at', 'DESC')->paginate($request->limit)->appends($request->all());

        return response()->json($this->content);
    }

    public function periods_by_level(Request $request, $id)
    {
        $periods = Period::select();

        if (empty($id)) {
            return redirect()->back();
        }

        if (!is_numeric($id)) {
            return redirect()->back();
        }

        $periods = $periods->where('level_id', $id);

        $this->content['http_code'] = 200;
        $this->content['status']    = 'success';

        $this->content['data'] = $periods->orderBy('created_at', 'DESC')->get();

        return response()->json($this->content);
    }

    public function politic_groups_by_level(Request $request, $id)
    {
        $politic_groups = PoliticGroup::select(['id','name']);

        if (empty($id)) {
            return redirect()->back();
        }

        if (!is_numeric($id)) {
            return redirect()->back();
        }

        $politic_groups = $politic_groups->where('level_id', $id);

        $this->content['http_code'] = 200;
        $this->content['status']    = 'success';

        $this->content['data'] = $politic_groups->orderBy('name', 'ASC')->get();

        return response()->json($this->content);
    }

    public function laws_projects_proposals(Request $request)
    {
        $laws      = Law::getLaws($request)->orderBy('created_at', 'DESC')->paginate($request->limit)->appends($request->all());
        $projects  = Project::getProjects($request)->orderBy('created_at', 'DESC')->paginate($request->limit)->appends($request->all());
        $proposals = Proposal::getProposals($request)->orderBy('created_at', 'DESC')->paginate($request->limit)->appends($request->all());

        $this->content['http_code'] = 200;
        $this->content['status']    = 'success';

        $this->content['data'] = [
            'laws'      => $laws,
            'projects'  => $projects,
            'proposals' => $proposals,
        ];

        return response()->json($this->content);
    }

    public function laws(Request $request)
    {
        $laws = Law::getLaws($request)->orderBy('created_at', 'DESC')->paginate($request->limit)->appends($request->all());

        $this->content['http_code'] = 200;
        $this->content['status']    = 'success';

        $this->content['data'] = $laws;

        return response()->json($this->content);
    }

    public function projects(Request $request)
    {
        $projects  = Project::getProjects($request)->orderBy('created_at', 'DESC')->paginate($request->limit)->appends($request->all());

        $this->content['http_code'] = 200;
        $this->content['status']    = 'success';

        $this->content['data'] = $projects;

        return response()->json($this->content);
    }

    public function proposals(Request $request)
    {
        $proposals = Proposal::getProposals($request)->orderBy('created_at', 'DESC')->paginate($request->limit)->appends($request->all());

        $this->content['http_code'] = 200;
        $this->content['status']    = 'success';

        $this->content['data'] = $proposals;

        return response()->json($this->content);
    }

    public function schedule_session(Request $request)
    {
        $schedules = ScheduleSession::getSchedule($request)->get();

        $this->content['http_code'] = 200;
        $this->content['status']    = 'success';

        $this->content['data'] = $schedules;

        return response()->json($this->content);
    }
}
