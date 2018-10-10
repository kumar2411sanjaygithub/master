<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Officials;
use App\Role;
use App\Department;
use App\Permission;
use App\Employee;
use App\ModelHasRoles;
use App\User;
use App\Roleofficial;
use App\Rolepermission;
use App\Officialspermission;
use App\Officialupdatestatus;
use App\Employeeupdatestatus;
use Carbon\Carbon;
use DB;
use Validator;
use Illuminate\Support\Facades\Redirect;
class ManageOfficialsController extends Controller
{

  public function departmentview()
  {
    $Department = Department::paginate(15);
    return view('ManageOfficials.department',compact('Department'));

  }
  public function savedepartment(Request $request)
  {
    $validator = Validator::make($request->all(),
     [
      'depatment_name' => 'required|min:1|unique:department,depatment_name,NULL,id,deleted_at,NULL',

      ]);
       if($validator->fails())
       {
        return Redirect::back()->withErrors($validator);
       }
       $department = new Department();
       $department->depatment_name = $request->input('depatment_name');
       $department->description = $request->input('description');
       $department->save();
       return redirect()->back()->with('message', 'Department Added Successfully!');
  }

  public function editdepartments($id)
  {

        $departmentData = Department::select('*')->where('id', $id)->first();
        return view('ManageOfficials.editdepartments',compact('departmentData'));
  }

  public function updatedepartmentdata(Request $request, $id)
  {
        $validator = Validator::make($request->all(), 
          [
            'depatment_name' => 'required|max:50',
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        $department = Department::find($id);
        $department->depatment_name = $request->input('depatment_name');
        $department->description = $request->input('description');
        $department->update();
        return redirect('/departments')->with('updatemsg', 'Record Updated Successfully!');
  }

  public function deletedepartments($id)
  {
        $department = Department::find($id);
        $department->destroy($id);
        return redirect()->back()->with('delmsg', 'Record Deleted Successfully!');
  }

  public function employeeview()
  {
        $employeeData = User::where('emp_app_status','1')->where('id','!=',1)->paginate(15);
        return view('ManageOfficials.employeeview',compact('employeeData'));
  }

  public function employeepermissionview()
  {
        $department = Department::get();
        $role = Role::get();
    return view('ManageOfficials.employee',compact('rolepermissionData','role','department','rolepermission'));
  }

  public function saveemployeesdata(Request $request)
  {
        $this->validate($request,[
          'name' => 'required|regex:/^[a-zA-Z ]*$/|max:50',
          'employee_id'=>'required|regex:/^[0-9A-Za-z.\-_]+$/|max:20',

          'contact_number' => 'required|unique:users|max:10|min:10|regex:/^[0-9]{10}$/',
          'telephone_number'=>'nullable|digits_between:4,15/',
          'username' => 'required|max:20',
          //'password' => 'max:20|required',
          'password' => 'required|min:6',
          'confirmed' => 'required|same:password',
          'email' => 'required|unique:users,email',
          'role_id' => 'required',
          'designation' => 'required|regex:/^[0-9A-Za-z.\-_ ]+$/|max:30',
          'department_id' => 'required',
          'line1' => 'required|max:100',
          'country' => 'required',
          'state' => 'required',
          'city' => 'required|regex:/^[a-zA-Z]+$/u|max:25',
          'pin_code' => 'required|max:6|min:6',
          'line2' => 'nullable|max:100',
          'country' => 'required',
          'comm_mob' => 'required|digits:10',
          'comm_telephone' => 'nullable|digits_between:4,15',
        ]);
        $employees = new User();
        $employees->name = $request->input('name');
        $employees->employee_id = $request->input('employee_id');
        $employees->email = $request->input('email');
        $employees->contact_number = $request->input('contact_number');
        $employees->telephone_number = $request->input('telephone_number');
        $employees->username = $request->input('username');
        $employees->password = $request->input('password');
        $employees->designation = $request->input('designation');
        $employees->department_id = $request->input('department_id');
        $employees->line1 = $request->input('line1');
        $employees->role = $request->input('role_id');
        $employees->line2 = $request->input('line2');
        $employees->country = $request->input('country');
        $employees->state = $request->input('state');
        $employees->city = $request->input('city');
        $employees->pin_code = $request->input('pin_code');
        $employees->comm_mob = $request->input('comm_mob');
        $employees->comm_telephone = $request->input('comm_telephone');
        $employees->save();
        $employee_id =$employees->id;

        if($request->input('role_id')!='')
        {

          $roleemployee = new ModelHasRoles();
          $roleemployee->model_id = $employee_id;
          $roleemployee->model_type = 'App\employees';
          $roleemployee->role_id = $request->input('role_id');
          $roleemployee->save();
        }
        return redirect('manageofficials/employeeview')->with('message', 'Employee details saved successfully and submitted for approval. ');
    }

  public function viewoneoemployeepermission($id)
  {
          $department = Department::get();
          $role = Role::get();
          $officialstData = User::select('*')->where('id', $id)->first();
          $off_role= ModelHasRoles::all()->where('model_id', $id)->toArray();
          $role_off = array_column($off_role, 'role_id');
          return view('ManageOfficials.viewoneemployee',compact('id','department','role','officialstData','role_off'));
  }
  public function editemployee($id)
  {
        $department = Department::get();
        $role = Role::get();
        $officialstData = User::select('*')->where('id', $id)->first();
        $off_role= ModelHasRoles::all()->where('model_id', $id)->toArray();
        $role_off = array_column($off_role, 'role_id');
        return view('ManageOfficials.editemployee',compact('id','officialpermission','department','official_permission','role','officialstData','role_off'));
  }

  public function updateemployee(Request $request, $id)
  {    
       $validator = Validator::make($request->all(), [
          'name' => 'required|regex:/^[a-zA-Z ]*$/|max:50',
          'employee_id'=>'required|regex:/^[0-9A-Za-z.\-_]+$/|max:20',

          'contact_number' => 'required|max:10|min:10|regex:/^[0-9]{10}$/',
          'telephone_number'=>'nullable|digits_between:4,15/',
          'username' => 'required|max:20',
          //'password' => 'max:20|required',
          'password' => 'required|min:6',
          'confirmed' => 'required|same:password',
          //'confirmed' => 'max:20|same:password',
          'email' => 'required|email',
          'role_id' => 'required',
          'designation' => 'required|regex:/^[0-9A-Za-z.\-_ ]+$/|max:30',
          'department_id' => 'required',
          'line1' => 'required|max:100',
          'country' => 'required',
          'state' => 'required',
          'city' => 'required|regex:/^[a-zA-Z]+$/u|max:25',
          'pin_code' => 'required|max:6|min:6',
          'line2' => 'nullable|max:100',
          'country' => 'required',
          'comm_mob' => 'required|digits:10',
          'comm_telephone' => 'nullable|digits_between:4,15',

        ]);
      if ($validator->fails())
       {
            return redirect()->back()->withInput()->withErrors($validator);
       }

        $employees =  User::find($id);
        $employees->name = $request->input('name');
        $employees->employee_id = $request->input('employee_id');
        $employees->email = $request->input('email');
        $employees->contact_number = $request->input('contact_number');
        $employees->telephone_number = $request->input('telephone_number');
        $employees->username = $request->input('username');
        $employees->password = $request->input('password');
        $employees->designation = $request->input('designation');
        $employees->department_id = $request->input('department_id');
        $employees->role = $request->input('role_id');
        $employees->line1 = $request->input('line1');
        $employees->line2 = $request->input('line2');
        $employees->country = $request->input('country');
        $employees->state = $request->input('state');
        $employees->city = $request->input('city');
        $employees->pin_code = $request->input('pin_code');
        $employees->comm_mob = $request->input('comm_mob');
        $employees->comm_telephone = $request->input('comm_telephone');
        $dierty = $employees->getDirty();
        $off_id =$employees->id;
        $pendding = Employeeupdatestatus::select('keyname')->where('employee_id',$id)->where('approve_status','0')->get()->toArray();
        $existing = array();
        $field_name = array(
            'name' => 'Employee',
            'email' => 'Email',
            'contact_number' => 'Contact Number',
            'telephone_number'=>'Telephone Number',
            'username' => 'User Name',
            'password' => 'Password',
            'role_id' => 'Role',
            'country'=>'Country',
            'state'=>'State',
            'designation' => 'Designation',
            'department_id' => 'Department',
            'comm_add_line1' => 'Address Line 1',
            'comm_add_line2' => 'Address Line 2',
            'comm_country' => 'Country',
            'comm_state' => 'State',
            'comm_city' => 'City',
            'pin_code' => 'Pin Code',
            'comm_mob'=>'Communication Mobile No.',
            'comm_telephone'=> 'Communication Telephome No.'
        );
        if(count($pendding)>0)
        {
            $pending = array_column($pendding,'keyname');
            foreach ($dierty as $key => $value) 
            {
               if(in_array($key, $pending))
               {
                  $existing[]=$key;

                  $validator->errors()->add($key, $field_name[$key].' update request is already pending.');
               }
            }
        }
        if(count($existing)>0)
        {
            return Redirect::back()->withErrors($validator);
        }

        $user_id=$id;
        $roles = $request->input('role_id');
        $update_has_role=ModelHasRoles::where('model_id',$user_id)->update(
         array(
                 'role_id' => $roles,
              )
         );
        foreach ($dierty as $key => $value)
         {
            if($key == "department_id")
            {
                $department = Department::where('id', $value)->pluck('depatment_name')->toArray();
                $key = "department_id";
                $value = $department[0];
            }
            if($key == "comm_state")
            {
                $state_list = \App\Common\StateList::get_states();
                $key  = "comm_state";
                $value = $state_list[$value]['name'];
            }
          $existing = new Employeeupdatestatus();
          $existing->employee_id = $id;
          $existing->keyname = $key;
          $existing->value = $value;
          $existing->type = "Employees";
          $existing->save();
        }
        return redirect('manageofficials/employeeview')->with('updatemsg', 'Employee update request has been successfully submitted for approval.');
    }

  public function deleteemployee($id)
  {
        User::destroy($id);
        return redirect()->back()->with('delmsg', 'Employee deleted successfully!');
  }
    public function getRoleAjax(Request $request)
    {
       $department_id=Role::where('department_id',$request['department_id'])->get();

      return response()->json(['role' => $department_id],200);
    }
}
