<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('Manage Leave Type'))
        {
            $leavetypes = LeaveType::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('leavetype.index', compact('leavetypes'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {

        if(\Auth::user()->can('Create Leave Type'))
        {
            return view('leavetype.create');
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {

        if(\Auth::user()->can('Create Leave Type'))
        {

            $validator = \Validator::make(
                $request->all(), [
                'title' => 'required',
                'days' => 'required',
            ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $leavetype             = new LeaveType();
            $leavetype->title      = $request->title;
            $leavetype->days       = $request->days;
            $leavetype->created_by = \Auth::user()->creatorId();
            $leavetype->save();

            return redirect()->route('leavetype.index')->with('success', __('LeaveType  successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(LeaveType $leavetype)
    {
        return redirect()->route('leavetype.index');
    }

    public function edit(LeaveType $leavetype)
    {
        if(\Auth::user()->can('Edit Leave Type'))
        {
            if($leavetype->created_by == \Auth::user()->creatorId())
            {

                return view('leavetype.edit', compact('leavetype'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, LeaveType $leavetype)
    {
        if(\Auth::user()->can('Edit Leave Type'))
        {
            if($leavetype->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                    'title' => 'required',
                    'days' => 'required',
                ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }

                $leavetype->title = $request->title;
                $leavetype->days  = $request->days;
                $leavetype->save();

                return redirect()->route('leavetype.index')->with('success', __('LeaveType successfully updated.'));
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

    public function destroy(LeaveType $leavetype)
    {
        if(\Auth::user()->can('Delete Leave Type'))
        {
            if($leavetype->created_by == \Auth::user()->creatorId())
            {
                $leavetype->delete();

                return redirect()->route('leavetype.index')->with('success', __('LeaveType successfully deleted.'));
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
