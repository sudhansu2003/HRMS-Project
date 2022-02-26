<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Document;
use App\Models\Employee;
use App\Models\EmployeeDocument;
use App\Mail\UserCreate;
use App\Models\User;
use App\Models\Utility;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Imports\EmployeeImport;
use App\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;

//use Faker\Provider\File;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(\Auth::user()->can('Manage Employee'))
        {
            if(Auth::user()->type == 'employee')
            {
                $employees = Employee::where('user_id', '=', Auth::user()->id)->get();
            }
            else
            {
                $employees = Employee::where('created_by', \Auth::user()->creatorId())->get();
                // dd($employees);
            }

            return view('employee.index', compact('employees'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('Create Employee'))
        {
            $company_settings = Utility::settings();
            $documents        = Document::where('created_by', \Auth::user()->creatorId())->get();
            $branches         = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $departments      = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designations     = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $employees        = User::where('created_by', \Auth::user()->creatorId())->get();

            $employeesId      = \Auth::user()->employeeIdFormat($this->employeeNumber());

            return view('employee.create', compact('employees', 'employeesId', 'departments', 'designations', 'documents', 'branches', 'company_settings'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('Create Employee'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'dob' => 'required',
                                   'gender' => 'required',
                                   'phone' => 'required',
                                   'address' => 'required',
                                   'email' => 'required|unique:users',
                                   'password' => 'required',
                                   'department_id' => 'required',
                                   'designation_id' => 'required',
                                   'document.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf,doc,zip|max:20480',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->withInput()->with('error', $messages->first());
            }

            $user = User::create(
                [
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'type' => 'employee',
                    'lang' => 'en',
                    'created_by' => \Auth::user()->creatorId(),
                ]
            );
            $user->save();
            $user->assignRole('Employee');


            if(!empty($request->document) && !is_null($request->document))
            {
                $document_implode = implode(',', array_keys($request->document));
            }
            else
            {
                $document_implode = null;
            }


            $employee = Employee::create(
                [
                    'user_id' => $user->id,
                    'name' => $request['name'],
                    'dob' => $request['dob'],
                    'gender' => $request['gender'],
                    'phone' => $request['phone'],
                    'address' => $request['address'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'employee_id' => $this->employeeNumber(),
                    'branch_id' => $request['branch_id'],
                    'department_id' => $request['department_id'],
                    'designation_id' => $request['designation_id'],
                    'company_doj' => $request['company_doj'],
                    'documents' => $document_implode,
                    'account_holder_name' => $request['account_holder_name'],
                    'account_number' => $request['account_number'],
                    'bank_name' => $request['bank_name'],
                    'bank_identifier_code' => $request['bank_identifier_code'],
                    'branch_location' => $request['branch_location'],
                    'tax_payer_id' => $request['tax_payer_id'],
                    'created_by' => \Auth::user()->creatorId(),
                ]
            );

            if($request->hasFile('document'))
            {
                foreach($request->document as $key => $document)
                {

                    $filenameWithExt = $request->file('document')[$key]->getClientOriginalName();
                    $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension       = $request->file('document')[$key]->getClientOriginalExtension();
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $dir             = storage_path('uploads/document/');
                    $image_path      = $dir . $filenameWithExt;

                    if(File::exists($image_path))
                    {
                        File::delete($image_path);
                    }

                    if(!file_exists($dir))
                    {
                        mkdir($dir, 0777, true);
                    }
                    $path              = $request->file('document')[$key]->storeAs('uploads/document/', $fileNameToStore);
                    $employee_document = EmployeeDocument::create(
                        [
                            'employee_id' => $employee['employee_id'],
                            'document_id' => $key,
                            'document_value' => $fileNameToStore,
                            'created_by' => \Auth::user()->creatorId(),
                        ]
                    );
                    $employee_document->save();

                }

            }

            $setings = Utility::settings();
            if($setings['employee_create'] == 1)
            {
                $user->type     = 'Employee';
                $user->password = $request['password'];
                try
                {
                    Mail::to($user->email)->send(new UserCreate($user));
                }
                catch(\Exception $e)
                {
                    $smtp_error = __('E-Mail has been not sent due to SMTP configuration');
                }

                return redirect()->route('employee.index')->with('success', __('Employee successfully created.') . (isset($smtp_error) ? $smtp_error : ''));

            }

            return redirect()->route('employee.index')->with('success', __('Employee  successfully created.'));

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        if(\Auth::user()->can('Edit Employee'))
        {
            $documents    = Document::where('created_by', \Auth::user()->creatorId())->get();
            $branches     = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $departments  = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designations = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $employee     = Employee::find($id);
            $employeesId  = \Auth::user()->employeeIdFormat($employee->employee_id);

            return view('employee.edit', compact('employee', 'employeesId', 'branches', 'departments', 'designations', 'documents'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function update(Request $request, $id)
    {

        if(\Auth::user()->can('Edit Employee'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'name' => 'required',
                                   'dob' => 'required',
                                   'gender' => 'required',
                                   'phone' => 'required|numeric',
                                   'address' => 'required',
                                   'document.*' => 'mimes:jpeg,png,jpg,gif,svg,pdf,doc,zip|max:20480',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $employee = Employee::findOrFail($id);

            if($request->document)
            {

                foreach($request->document as $key => $document)
                {
                    if(!empty($document))
                    {
                        $filenameWithExt = $request->file('document')[$key]->getClientOriginalName();
                        $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension       = $request->file('document')[$key]->getClientOriginalExtension();
                        $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                        $dir        = storage_path('uploads/document/');
                        $image_path = $dir . $filenameWithExt;

                        if(File::exists($image_path))
                        {
                            File::delete($image_path);
                        }
                        if(!file_exists($dir))
                        {
                            mkdir($dir, 0777, true);
                        }
                        $path = $request->file('document')[$key]->storeAs('uploads/document/', $fileNameToStore);


                        $employee_document = EmployeeDocument::where('employee_id', $employee->employee_id)->where('document_id', $key)->first();

                        if(!empty($employee_document))
                        {
                            $employee_document->document_value = $fileNameToStore;
                            $employee_document->save();
                        }
                        else
                        {
                            $employee_document                 = new EmployeeDocument();
                            $employee_document->employee_id    = $employee->employee_id;
                            $employee_document->document_id    = $key;
                            $employee_document->document_value = $fileNameToStore;
                            $employee_document->save();
                        }

                    }
                }
            }

            $employee = Employee::findOrFail($id);
            $input    = $request->all();
            $employee->fill($input)->save();
            if($request->salary)
            {
                return redirect()->route('setsalary.index')->with('success', 'Employee successfully updated.');
            }

            if(\Auth::user()->type != 'employee')
            {
                return redirect()->route('employee.index')->with('success', 'Employee successfully updated.');
            }
            else
            {
                return redirect()->route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id))->with('success', 'Employee successfully updated.');
            }

        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy($id)
    {

        if(Auth::user()->can('Delete Employee'))
        {
            $employee      = Employee::findOrFail($id);
            $user          = User::where('id', '=', $employee->user_id)->first();
            $emp_documents = EmployeeDocument::where('employee_id', $employee->employee_id)->get();
            $employee->delete();
            $user->delete();
            $dir = storage_path('uploads/document/');
            foreach($emp_documents as $emp_document)
            {
                $emp_document->delete();
                if(!empty($emp_document->document_value))
                {
                    unlink($dir . $emp_document->document_value);
                }

            }

            return redirect()->route('employee.index')->with('success', 'Employee successfully deleted.');
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function show($id)
    {

        if(\Auth::user()->can('Show Employee'))
        {
            $empId        = Crypt::decrypt($id);
            $documents    = Document::where('created_by', \Auth::user()->creatorId())->get();
            $branches     = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $departments  = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designations = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $employee     = Employee::find($empId);
            $employeesId  = \Auth::user()->employeeIdFormat($employee->employee_id);

            return view('employee.show', compact('employee', 'employeesId', 'branches', 'departments', 'designations', 'documents'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function json(Request $request)
    {
        $designations = Designation::where('department_id', $request->department_id)->get()->pluck('name', 'id')->toArray();

        return response()->json($designations);
    }

    function employeeNumber()
    {
        $latest = Employee::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->employee_id + 1;
    }

    public function profile(Request $request)
    {
        if(\Auth::user()->can('Manage Employee Profile'))
        {
            $employees = Employee::where('created_by', \Auth::user()->creatorId());
            if(!empty($request->branch))
            {
                $employees->where('branch_id', $request->branch);
            }
            if(!empty($request->department))
            {
                $employees->where('department_id', $request->department);
            }
            if(!empty($request->designation))
            {
                $employees->where('designation_id', $request->designation);
            }
            $employees = $employees->get();

            $brances = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $brances->prepend('All', '');

            $departments = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $departments->prepend('All', '');

            $designations = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designations->prepend('All', '');

            return view('employee.profile', compact('employees', 'departments', 'designations', 'brances'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function profileShow($id)
    {
        if(\Auth::user()->can('Show Employee Profile'))
        {
            $empId        = Crypt::decrypt($id);
            $documents    = Document::where('created_by', \Auth::user()->creatorId())->get();
            $branches     = Branch::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $departments  = Department::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $designations = Designation::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $employee     = Employee::find($empId);
            $employeesId  = \Auth::user()->employeeIdFormat($employee->employee_id);

            return view('employee.show', compact('employee', 'employeesId', 'branches', 'departments', 'designations', 'documents'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function lastLogin()
    {
        $users = User::where('created_by', \Auth::user()->creatorId())->get();

        return view('employee.lastLogin', compact('users'));
    }

    public function employeeJson(Request $request)
    {
        $employees = Employee::where('branch_id', $request->branch)->get()->pluck('name', 'id')->toArray();

        return response()->json($employees);
    }
    public function importFile()
    {
        return view('employee.import');
    }
    
    public function import(Request $request)
    {
        $rules = [
            'file' => 'required|mimes:csv,txt',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $employees = (new EmployeeImport())->toArray(request()->file('file'))[0];
        $totalCustomer = count($employees) - 1;
        $errorArray    = [];
        
        for ($i = 1; $i <= count($employees) - 1; $i++) {

            $employee = $employees[$i];
            
            $employeeByEmail = Employee::where('email', $employee[5])->first();
            $userByEmail = User::where('email', $employee[5])->first();
            
            // dd($userByEmail);

            if (!empty($employeeByEmail) && !empty($userByEmail)) {
                $employeeData = $employeeByEmail;
            } else {

                $user = new User();
                $user->name = $employee[0];
                $user->email = $employee[5];
                $user->password = Hash::make($employee[6]);
                $user->type = 'employee';
                $user->lang = 'en';
                $user->created_by = \Auth::user()->creatorId();
                $user->save();
                $user->assignRole('Employee');

                $employeeData = new Employee();
                $employeeData->employee_id      = $this->employeeNumber();
                $employeeData->user_id             = $user->id;
            }


            $employeeData->name                = $employee[0];
            $employeeData->dob                 = $employee[1];
            $employeeData->gender              = $employee[2];
            $employeeData->phone               = $employee[3];
            $employeeData->address             = $employee[4];
            $employeeData->email               = $employee[5];
            $employeeData->password            = Hash::make($employee[6]);
            $employeeData->branch_id           = $employee[8];
            $employeeData->department_id       = $employee[9];
            $employeeData->designation_id      = $employee[10];
            $employeeData->company_doj         = $employee[11];
            $employeeData->account_holder_name = $employee[12];
            $employeeData->account_number      = $employee[13];
            $employeeData->bank_name           = $employee[14];
            $employeeData->bank_identifier_code = $employee[15];
            $employeeData->branch_location     = $employee[16];
            $employeeData->tax_payer_id        = $employee[17];
            $employeeData->created_by          = \Auth::user()->creatorId();

            if (empty($employeeData)) {
                $errorArray[] = $employeeData;
            } else {
                $employeeData->save();
            }
        }

        $errorRecord = [];
        if (empty($errorArray)) {
            $data['status'] = 'success';
            $data['msg']    = __('Record successfully imported');
        } else {
            $data['status'] = 'error';
            $data['msg']    = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalCustomer . ' ' . 'record');


            foreach ($errorArray as $errorData) {

                $errorRecord[] = implode(',', $errorData);
            }

            \Session::put('errorArray', $errorRecord);
        }

        return redirect()->back()->with($data['status'], $data['msg']);
    }

    public function export()
    {
        $name = 'employee_' . date('Y-m-d i:h:s');
        $data = Excel::download(new EmployeeExport(), $name . '.xlsx'); ob_end_clean();

        return $data;
    }


}
