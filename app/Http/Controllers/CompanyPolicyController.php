<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CompanyPolicy;
use App\Models\Utility;
use Illuminate\Http\Request;

class CompanyPolicyController extends Controller
{

    public function index()
    {
        if (\Auth::user()->can('Manage Company Policy')) {
            $companyPolicy = CompanyPolicy::where('created_by', '=', \Auth::user()->creatorId())->get();

            return view('companyPolicy.index', compact('companyPolicy'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        if (\Auth::user()->can('Create Company Policy')) {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $branch->prepend('Select Branch', '');

            return view('companyPolicy.create', compact('branch'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }


    public function store(Request $request)
    {
        if (\Auth::user()->can('Create Company Policy')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'branch' => 'required',
                    'title' => 'required',
                    'attachment' => 'mimes:jpeg,png,jpg,gif,pdf,doc,zip|max:20480',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            if (!empty($request->attachment)) {
                $filenameWithExt = $request->file('attachment')->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension       = $request->file('attachment')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $dir             = storage_path('uploads/companyPolicy/');

                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $path = $request->file('attachment')->storeAs('uploads/companyPolicy/', $fileNameToStore);
            }

            $policy              = new CompanyPolicy();
            $policy->branch      = $request->branch;
            $policy->title       = $request->title;
            $policy->description = $request->description;
            $policy->attachment  = !empty($request->attachment) ? $fileNameToStore : '';
            $policy->created_by  = \Auth::user()->creatorId();
            $policy->save();

            // slack 
            $setting = Utility::settings(\Auth::user()->creatorId());
            $branch = Branch::find($request->branch);
            if (isset($setting['company_policy_notification']) && $setting['company_policy_notification'] == 1) {
                $msg = $request->title . ' ' . __("for") . ' ' . $branch->name . ' ' . __("created") . '.';
                Utility::send_slack_msg($msg);
            }

            // telegram 
            $setting = Utility::settings(\Auth::user()->creatorId());
            $branch = Branch::find($request->branch);
            if (isset($setting['telegram_company_policy_notification']) && $setting['telegram_company_policy_notification'] == 1) {
                $msg = $request->title . ' ' . __("for") . ' ' . $branch->name . ' ' . __("created") . '.';
                Utility::send_telegram_msg($msg);
            }

            return redirect()->route('company-policy.index')->with('success', __('Company policy successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function show(CompanyPolicy $companyPolicy)
    {
        //
    }


    public function edit(CompanyPolicy $companyPolicy)
    {

        if (\Auth::user()->can('Edit Company Policy')) {
            $branch = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $branch->prepend('Select Branch', '');

            return view('companyPolicy.edit', compact('branch', 'companyPolicy'));
        } else {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }


    public function update(Request $request, CompanyPolicy $companyPolicy)
    {
        if (\Auth::user()->can('Create Company Policy')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'branch' => 'required',
                    'title' => 'required',
                    'attachment' => 'mimes:jpeg,png,jpg,gif,pdf,doc,zip|max:20480',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            if (isset($request->attachment)) {
                $filenameWithExt = $request->file('attachment')->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension       = $request->file('attachment')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $dir             = storage_path('uploads/companyPolicy/');

                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }
                $path = $request->file('attachment')->storeAs('uploads/companyPolicy/', $fileNameToStore);
            }

            $companyPolicy->branch      = $request->branch;
            $companyPolicy->title       = $request->title;
            $companyPolicy->description = $request->description;
            if (isset($request->attachment)) {
                $companyPolicy->attachment = $fileNameToStore;
            }
            $companyPolicy->created_by = \Auth::user()->creatorId();
            $companyPolicy->save();

            return redirect()->route('company-policy.index')->with('success', __('Company policy successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function destroy(CompanyPolicy $companyPolicy)
    {

        if (\Auth::user()->can('Delete Document')) {
            if ($companyPolicy->created_by == \Auth::user()->creatorId()) {
                $companyPolicy->delete();

                $dir = storage_path('uploads/companyPolicy/');
                if (!empty($companyPolicy->attachment)) {
                    unlink($dir . $companyPolicy->attachment);
                }

                return redirect()->route('company-policy.index')->with('success', __('Company policy successfully deleted.'));
            } else {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
