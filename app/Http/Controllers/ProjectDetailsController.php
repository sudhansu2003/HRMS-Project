<?php
use App\Models\User;
use App\Models\UserProjectMapping;
namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use App\Models\ProjectAssign;
use App\Models\UserProjectMapping;
use App\Models\Meeting;
use App\Models\MeetingEmployee;
use Illuminate\Http\Request;
use App\Models\Utility;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectDetailsController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('Manage Project Assign'))
        {
            $result = ProjectAssign::get();
            return view('projectassign.index',compact('result'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function create()
    {
        if(\Auth::user()->can('Create Project Assign'))
        {
            return view('projectassign.create');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function store(Request $request)
    {
        // echo 123;exit;
        // dd($request->all());
        if(\Auth::user()->can('Create Project Assign'))
        {
            $projectassign = new ProjectAssign();

            $projectassign->project_name = $request->input('project_name');
            $projectassign->client_name = $request->input('client_name');
            $projectassign->deal_date = $request->input('deal_date');
            $projectassign->start_date = $request->input('start_date');
            $projectassign->estimated_delivery_date = $request->input('estimated_delivery_date');
            $projectassign->early_delivery = $request->input('early_delivery');
            $projectassign->late_delivery = $request->input('late_delivery');

            // $projectassign->save();

            if (!ProjectAssign::where('project_name', $projectassign->project_name)->exists()) {
                // Save the new project
                $projectassign->save();
                $result = ProjectAssign::get();
                return view('projectassign.index', compact('result'));
            } else {
                // Handle the case where a project with the same name already exists
                return redirect()->back()->with('error', 'Project with the same name already exists.');
            }

        }
        else 
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
        
    public function edit($project_id)
    {
        if(\Auth::user()->can('Edit Project Assign'))
        {
            $project = ProjectAssign::where('project_id','=',$project_id)->first();
            // print "<pre>";
            // print_r($project);exit;
            return view('projectassign.edit', compact('project'));
        }
        else
        {
            return redirect()->back()->with('error', 'Project dont exist');

        }
    }

    public function update(Request $request,$project_id)
    {
        // echo $project_id;
        // dd($request->all());
        if(\Auth::user()->can('Edit Project Assign'))
        {
            // echo 123;exit;
            $projectAssign = ProjectAssign::find($project_id);
            // print "<pre>";
            // print_r($projectAssign);exit;
            if($projectAssign)
            {
                $projectAssign->update([
                    'project_name' => $request->input('project_name'),
                    'client_name' => $request->input('client_name'),
                    'deal_date' => $request->input('deal_date'),
                    'start_date' => $request->input('start_date'),
                    'estimated_delivery_date' => $request->input('estimated_delivery_date'),
                    'actual_delivery' => $request->input('actual_delivery'),
                    'early_delivery' => $request->input('early_delivery'),
                    'late_delivery' => $request->input('late_delivery'),
                ]);
                // $ProjectAssign->save();
                $result = ProjectAssign::get();
            //     print "<pre>";
            // print_r($result);exit;
            }
            else
            {
                return redirect()->back()->with('error', 'Project not found');
            }
            return view('projectassign.index', compact('result'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');

        }
    }

    public function destroy(Request $request,$project_id)
    {
        // echo $id;exit;
        if(\Auth::user()->can('Delete Project Assign'))
        {
            $project = ProjectAssign::find($project_id);
            
            if($project)
            {
                $project->delete();
                // $result = AssignProject::get();
                // print "<pre>";
                // print_r($result);exit;
            }
            else
            {
                return redirect()->back()->with('error', 'Project not found');
            }
            $result = ProjectAssign::get();
            return view('projectassign.index', compact('result'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function assignIndex()
    {
        if(\Auth::user()->can('Manage Project Assign'))
        {
            $result = UserProjectMapping::select('user_project_mapping.user_id', 'user_project_mapping.project_id', 'users.name as user_name', 'project_assigns.project_name')
            ->join('users', 'user_project_mapping.user_id', '=', 'users.id')
            ->join('project_assigns', 'user_project_mapping.project_id', '=', 'project_assigns.project_id')
            ->get();

            return view('projectassign.assigned',compact('result'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
    public function createAssign(Request $request)
    {
        if(\Auth::user()->can('Create Project Assign'))
        {
           $result = UserProjectMapping::get();
        //    print "<pre>";
        //    print_r($result);exit;
            return view('projectassign.createassign',compact('data','projectName','usersWithoutProject'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function assignProject(Request $request,$project_id)
    {
        if(\Auth::user()->can('Create Project Assign'))
        {

            $projectName = ProjectAssign::where('project_id','=',$project_id)->get(['project_name']);

            $usersWithProject = DB::table('users as usr')
                ->select('usr.id as user_id', 'usr.name as user_name')
                ->join('user_project_mapping as upm', 'usr.id', '=', 'upm.user_id')
                ->where('upm.project_id', '=', $project_id)
                ->get();

            $assignedUserIds = UserProjectMapping::where('project_id','=', $project_id)->pluck('user_id');
            $usersWithoutProject = User::select('id as user_id', 'name as user_name')
                ->whereNotIn('id', $assignedUserIds)
                ->get();

            return view('projectassign.assignicon',compact('usersWithProject','projectName','usersWithoutProject'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
    public function storeAssign(Request $request)
    {
        // dd($request->all());
        if(\Auth::user()->can('Create Project Assign'))
        {
            $id = $request->id;
            // echo $id;exit;
            $project_name = $request->project_name;
            //  echo $project_name;exit;
            $project_id = ProjectAssign::where('project_name','=',$project_name)->value('project_id');
            // print "<pre>";
            // print_r($project_id);exit;
            $role = User::where('id','=',$id)->value('type');
            $userProjectMapping = new UserProjectMapping();
            $userProjectMapping->create([
                'user_id' => $request->input('id'),
                'project_id' => $project_id,
                'role' => $role,
                'status' => 1
            ]);
            $result = ProjectAssign::get();

            return view('projectassign.index',compact('result'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function deleteAssignedUser(Request $request)
    {
        if(\Auth::user()->can('Delete Project Assign'))
        {
            $name = $request->user_name;
            $projectName = $request->project_name;

            $user_id = User::where('name','=',$name)->value('id');

            $project_id = ProjectAssign::where('project_name','=',$projectName)->value('project_id');

            $deleteUser = UserProjectMapping::where('user_id',$user_id)
                          ->where('project_id',$project_id)
                          ->delete();

            $result = ProjectAssign::get();

            return view('projectassign.index',compact('result'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}