<?php

namespace App\Http\Controllers;

use App\Models\Appraisal;
use App\Models\Branch;
use App\Models\Competencies;
use App\Models\Employee;
use App\Models\Performance_Type;
use Illuminate\Http\Request;

class AppraisalController extends Controller
{

    public function index()
    {
        if(\Auth::user()->can('Manage Appraisal'))
        {
            $user = \Auth::user();
            if($user->type == 'employee')
            {
                $employee   = Employee::where('user_id', $user->id)->first();
                $appraisals = Appraisal::where('created_by', '=', \Auth::user()->creatorId())->where('branch', $employee->branch_id)->where('employee', $employee->id)->get();
            }
            else
            {
                $appraisals = Appraisal::where('created_by', '=', \Auth::user()->creatorId())->get();
            }

            return view('appraisal.index', compact('appraisals'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        if(\Auth::user()->can('Create Appraisal'))
        {
            $employee   = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name','id');
            $employee->prepend('Select Employee', '');
            // dd($employee);
            
            $brances = Branch::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $brances->prepend('Select Branch', '');

            $performance_types = Performance_Type::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('appraisal.create', compact('employee', 'brances', 'performance_types'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function store(Request $request)
    {

        if(\Auth::user()->can('Create Appraisal'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'branch' => 'required',
                                   'employee' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $appraisal                 = new Appraisal();
            $appraisal->branch         = $request->branch;
            $appraisal->employee       = $request->employee;
            $appraisal->appraisal_date = $request->appraisal_date;
            $appraisal->rating         = json_encode($request->rating, true);
            $appraisal->remark         = $request->remark;
            $appraisal->created_by     = \Auth::user()->creatorId();
            $appraisal->save();

            return redirect()->route('appraisal.index')->with('success', __('Appraisal successfully created.'));
        }
    }

    public function show(Appraisal $appraisal)
    {
        $ratings = json_decode($appraisal->rating, true);
        $performance_types = Performance_Type::where('created_by', '=', \Auth::user()->creatorId())->get();

        return view('appraisal.show', compact('appraisal', 'performance_types', 'ratings'));
    }


    public function edit(Appraisal $appraisal)
    {
        if(\Auth::user()->can('Edit Appraisal'))
        {
            $performance_types = Performance_Type::where('created_by', '=', \Auth::user()->creatorId())->get();

            $employee   = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name','id');
            $employee->prepend('Select Employee', '');
            
            $brances = Branch::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $brances->prepend('Select Branch', '');

            $ratings = json_decode($appraisal->rating,true);

            return view('appraisal.edit', compact('brances', 'employee', 'appraisal', 'performance_types','ratings'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function update(Request $request, Appraisal $appraisal)
    {
        if(\Auth::user()->can('Edit Appraisal'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'branch' => 'required',
                                   'employee' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $appraisal->branch         = $request->branch;
            $appraisal->employee       = $request->employee;
            $appraisal->appraisal_date = $request->appraisal_date;
            $appraisal->rating         = json_encode($request->rating, true);
            $appraisal->remark         = $request->remark;
            $appraisal->save();

            return redirect()->route('appraisal.index')->with('success', __('Appraisal successfully updated.'));
        }
    }


    public function destroy(Appraisal $appraisal)
    {
        if(\Auth::user()->can('Delete Appraisal'))
        {
            if($appraisal->created_by == \Auth::user()->creatorId())
            {
                $appraisal->delete();

                return redirect()->route('appraisal.index')->with('success', __('Appraisal successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
