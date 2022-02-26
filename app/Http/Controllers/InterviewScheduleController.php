<?php

namespace App\Http\Controllers;

use App\Models\InterviewSchedule;
use App\Models\JobApplication;
use App\Models\JobStage;
use App\Models\User;
use Illuminate\Http\Request;

class InterviewScheduleController extends Controller
{

    public function index()
    {
        $schedules   = InterviewSchedule::where('created_by', \Auth::user()->creatorId())->get();
        $arrSchedule = [];

        foreach($schedules as $schedule)
        {
            $arr['id']     = $schedule['id'];
            $arr['title']  = !empty($schedule->applications) ? !empty($schedule->applications->jobs) ? $schedule->applications->jobs->title : '' : '';
            $arr['start']  = $schedule['date'];
            $arr['url']    = route('interview-schedule.show', $schedule['id']);
            $arrSchedule[] = $arr;
        }
        $arrSchedule = str_replace('"[', '[', str_replace(']"', ']', json_encode($arrSchedule)));

        return view('interviewSchedule.index', compact('arrSchedule', 'schedules'));
    }

    public function create($candidate=0)
    {

        $employees = User::where('created_by', \Auth::user()->creatorId())->where('type', 'employee')->orWhere('id', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $employees->prepend('--', '');

        $candidates = JobApplication::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $candidates->prepend('--', '');

        return view('interviewSchedule.create', compact('employees', 'candidates','candidate'));
    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Interview Schedule'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'candidate' => 'required',
                                   'employee' => 'required',
                                   'date' => 'required',
                                   'time' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $schedule             = new InterviewSchedule();
            $schedule->candidate  = $request->candidate;
            $schedule->employee   = $request->employee;
            $schedule->date       = $request->date;
            $schedule->time       = $request->time;
            $schedule->comment    = $request->comment;
            $schedule->created_by = \Auth::user()->creatorId();
            $schedule->save();

            return redirect()->back()->with('success', __('Interview schedule successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function show(InterviewSchedule $interviewSchedule)
    {
        $stages=JobStage::where('created_by',\Auth::user()->creatorId())->get();
        return view('interviewSchedule.show', compact('interviewSchedule','stages'));
    }

    public function edit(InterviewSchedule $interviewSchedule)
    {
        $employees = User::where('created_by', \Auth::user()->creatorId())->where('type', 'employee')->orWhere('id', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $employees->prepend('--', '');

        $candidates = JobApplication::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
        $candidates->prepend('--', '');

        return view('interviewSchedule.edit', compact('employees', 'candidates', 'interviewSchedule'));
    }

    public function update(Request $request, InterviewSchedule $interviewSchedule)
    {
        if(\Auth::user()->can('Edit Interview Schedule'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'candidate' => 'required',
                                   'employee' => 'required',
                                   'date' => 'required',
                                   'time' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $interviewSchedule->candidate = $request->candidate;
            $interviewSchedule->employee  = $request->employee;
            $interviewSchedule->date      = $request->date;
            $interviewSchedule->time      = $request->time;
            $interviewSchedule->comment   = $request->comment;
            $interviewSchedule->save();

            return redirect()->back()->with('success', __('Interview schedule successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(InterviewSchedule $interviewSchedule)
    {
        $interviewSchedule->delete();

        return redirect()->back()->with('success', __('Interview schedule successfully deleted.'));
    }
}
