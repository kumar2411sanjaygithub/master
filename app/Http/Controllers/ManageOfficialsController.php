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
    $Department = Department::get();
    return view('ManageOfficials.department',compact('Department'));

  }
  public function savedepartment(Request $request){

    $validator = Validator::make($request->all(), [
           'depatment_name' => 'required|regex:/^[a-zA-Z ]*$/|min:1|unique:department,depatment_name,NULL,id,deleted_at,NULL',

       ]);

       if($validator->fails())
       {
           // dd($validator);
           return Redirect::back()->withErrors($validator);
       }
       //date_default_timezone_set('Asia/Calcutta');

       $department = new Department();
      //dd(1);
       $department->depatment_name = $request->input('depatment_name');
       $department->description = $request->input('description');
       //dd($department->description);
       $department->save();
       // return redirect('departments')->with('message', 'Data Save Successfully!');
       return redirect()->back()->with('message', 'Data Save Successfully!');
  }
  public function editdepartments($id)
    {

        $departmentData = Department::select('*')->where('id', $id)->first();

        return view('ManageOfficials.editdepartments',compact('departmentData'));
    }

    public function updatedepartmentdata(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'depatment_name' => 'required|max:50',

        ]);
        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        }
        $department = Department::find($id);
        $department->depatment_name = $request->input('depatment_name');
        $department->description = $request->input('description');
        // $v = $department->getDirty();
        $department->update();
        return redirect('/departments')->with('updatemsg', 'Data Update Successfully!');
    }

    public function deletedepartments($id)
    {
        $department = Department::find($id);

        //$department->role()->delete();
        //dd($department);
        $department->destroy($id);
        //$deletedRows = Department::where('id',$id)->delete();
        return redirect()->back()->with('delmsg', 'Data Deleted Successfully!');
    }

    public function employeeview(){
      $employeeData = User::all()->where('emp_app_status','1');
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
       //dd(1);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25|regex:/^[a-zA-Z ]*$/|max:50',
            'employee_id'=>'required|max:20',
            'email' => 'required|email|unique:users|max:80',
            'contact_number' => 'required|unique:employee_temp|max:10|min:10|regex:/^[0-9]{10}$/',
            //'telephone_number'=>'max:20|min:10|regex:/(01)[0-9]{9}/',
            'username' => 'required|max:20',
            'password' => 'max:20|required',
            'confirmed' => 'max:20|same:password',
            'role_id' => 'required',
            'designation' => 'required|max:20|regex:/^[a-zA-Z ]*$/|max:50',
            'department_id' => 'required',
            'line1' => 'required|max:100',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required|regex:/^[a-zA-Z]+$/u|max:25',
            'pin_code' => 'required|max:6|min:6',
        ],
        [
            'name' => 'Please Enter  Name',
            'email' => 'Please Enter Email',
            'contact_number' => 'Please Enter Mobile No.',
           // 'telephone_number' => 'Please Enter valid landline No.',
            'username' => 'Please Enter User Name',
            'password' => 'Please Enter Password',
            'role_id' => 'Please Select Role',
            'designation' => 'Please Enter Designation',
            'department_id' => 'Please Department',
            'line1' => 'Please Enter Address Line 1',
            'country' => 'Please Select Country',
            'state' => 'Please Select State',
            'city' => 'Please Enter City',
            'pin_code' => 'Please Enter Pin Code',
        ]);
        if($validator->fails())
        {

            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        
        $employees = new User();
        $employees->name = $request->input('name');
        $employees->employee = $request->input('employee');

        $employees->employee_id = $request->input('employee_id');
        $employees->email = $request->input('email');

        $employees->contact_number = $request->input('contact_number');
        $employees->telephone_number = $request->input('telephone_number');
        $employees->username = $request->input('username');
        $employees->password = $request->input('password');
        $employees->designation = $request->input('designation');
        $employees->department_id = $request->input('department_id');
        //$employees->role_id = $request->input('role_id');
        $employees->line1 = $request->input('role_id');
        $employees->role = $request->input('line1');
        $employees->line2 = $request->input('line2');
        $employees->country = $request->input('country');
        $employees->state = $request->input('state');
        $employees->city = $request->input('city');
        $employees->pin_code = $request->input('pin_code');
        $employees->comm_mob = $request->input('comm_mob');
        $employees->comm_telephone = $request->input('comm_telephone');
        $employees->save();
        //dd($employees);
        // save role_officials table data here
        $employee_id =$employees->id;
      //dd($request->input('role_id'));

        if($request->input('role_id')!=''){

          $roleemployee = new ModelHasRoles();
          $roleemployee->model_id = $employee_id;
          $roleemployee->model_type = 'App\employees';
          $roleemployee->role_id = $request->input('role_id');
          $roleemployee->save();
        }
        // save officials_permission data Here

        return redirect('manageofficials/employeeview')->with('message', 'Data Save Successfully!');
    }
    public function viewoneoemployeepermission($id)
    {
      //dd($id);
            //$b = Officialspermission::all()->where('officials_id', $id)->toArray();
            //$a = array_column($b, 'permission_id');
            //$official_permission = array_combine($a, $b);
            $department = Department::get();
            //$officialpermission = Permission::all();
            $role = Role::get();
            $officialstData = User::select('*')->where('id', $id)->first();
            //dd($officialstData);
            $off_role= ModelHasRoles::all()->where('model_id', $id)->toArray();
            $role_off = array_column($off_role, 'role_id');
            return view('ManageOfficials.viewoneemployee',compact('id','department','role','officialstData','role_off'));
  }
   public function editemployee($id)
    {

        $department = Department::get();

        $role = Role::get();

        $officialstData = User::select('*')->where('id', $id)->first();
        //dd($officialstData);
        $off_role= ModelHasRoles::all()->where('model_id', $id)->toArray();

        $role_off = array_column($off_role, 'role_id');

        return view('ManageOfficials.editemployee',compact('id','officialpermission','department','official_permission','role','officialstData','role_off'));
    }
    public function updateemployee(Request $request, $id)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25|regex:/^[a-zA-Z ]*$/|max:50',
            'employee_id'=>'required|max:20',
            
            'contact_number' => 'required|unique:users|max:10|min:10|regex:/^[0-9]{10}$/',
            //'telephone_number'=>'max:20|min:10|regex:/(01)[0-9]{9}/',
            'username' => 'required|max:20',
            'password' => 'max:20|required',
            'confirmed' => 'max:20|same:password',
            'role_id' => 'required',
            'designation' => 'required|max:20|regex:/^[a-zA-Z ]*$/|max:50',
            'department_id' => 'required',
            'line1' => 'required|max:100',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required|regex:/^[a-zA-Z]+$/u|max:25',
            'pin_code' => 'required|max:6|min:6',
        ],
        [
            'name' => 'Please Enter  Name',
            'email' => 'Please Enter Email',
            'contact_number' => 'Please Enter Mobile No.',
           // 'telephone_number' => 'Please Enter valid landline No.',
            'user_name' => 'Please Enter User Name',
            'password' => 'Please Enter Password',
            'role_id' => 'Please Select Role',
            'designation' => 'Please Enter Designation',
            'department_id' => 'Please Department',
            'line1' => 'Please Enter Address Line 1',
            'country' => 'Please Select Country',
            'state' => 'Please Select State',
            'city' => 'Please Enter City',
            'pin_code' => 'Please Enter Pin Code',
        ]);
        if($validator->fails())
        {

            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        
       
        $employees =  User::find($id);
        $employees->name = $request->input('name');

        $employees->employee_id = $request->input('employee_id');
        $employees->email = $request->input('email');

        $employees->mob_number = $request->input('contact_number');
        $employees->telephone_number = $request->input('telephone_number');
        $employees->username = $request->input('username');
        $employees->password = $request->input('password');
        $employees->designation = $request->input('designation');
        $employees->department_id = $request->input('department_id');
        //$employees->role_id = $request->input('role_id');
        $employees->line1 = $request->input('line1');
        $employees->line2 = $request->input('line2');
        $employees->country = $request->input('country');
        $employees->state = $request->input('state');
        $employees->city = $request->input('city');
        $employees->pin_code = $request->input('pin_code');

        // $officialstemp->role_id = $request->input('role_id');

        $dierty = $employees->getDirty();
        //dd($dierty);
        $off_id =$employees->id;
        $pendding = Employeeupdatestatus::select('keyname')->where('employee_id',$id)->where('approve_status','0')->get()->toArray();
        $existing = array();
        $field_name = array(
            'name' => 'Employee',
            'email' => 'Email',
            'contact_number' => 'Contact Number',
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
            'comm_pin_code' => 'Pin Code',
        );
        if(count($pendding)>0)
        {

            $pending = array_column($pendding,'keyname');
            //dd($dierty);
            foreach ($dierty as $key => $value) {
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

        //$update_role = ModelHasRoles::fine('model_id', $id)->pluck('role_id');

        //$rol_id =ModelHasRoles::where('model_id', $id)->where('role_id',$roles)->pluck('id');
             //dd($rol_id[0]);
             $update_has_role=ModelHasRoles::where('model_id',$user_id)->update(
         array(
                 'role_id' => $roles,
              )
         );
          // dd($update_has_role);
        // }

        //$off_id =$employees->id;


        foreach ($dierty as $key => $value) {
           // dd($key);
            if($key == "department_id"){
                $department = Department::where('id', $value)->pluck('depatment_name')->toArray();
                $key = "department_id";
                $value = $department[0];
                // dd($department);
            }
            if($key == "comm_state"){
                $state_list = \App\Common\StateList::get_states();
                $key  = "comm_state";
                // dd($state_list);
                $value = $state_list[$value]['name'];

            }
          $existing = new Employeeupdatestatus();
          $existing->employee_id = $id;
          $existing->keyname = $key;
          $existing->value = $value;
          $existing->type = "Employees";
          $existing->save();
        }

        // $officialspermissiontemp = new Officialspermission();

        // $permission = $request->permission;
        // if($permission!=''){
        // foreach ($permission as $key => $value) {
        //   $officialspermissiontemp = Officialspermission::firstOrNew(array('officials_id'=>$off_id, 'permission_id'=>$key));
        //   $officialspermissiontemp->officials_id = $off_id;

        //   $officialspermissiontemp->permission_id = $key;

        //   $officialspermissiontemp->o_p_add = isset($value['add'])?$value['add']:'';

        //   $officialspermissiontemp->o_p_edit = isset($value['edit'])?$value['edit']:'';

        //   $officialspermissiontemp->o_p_view = isset($value['view'])?$value['view']:'';
        //   $officialspermissiontemp->o_p_delete = isset($value['delete'])?$value['delete']:'';
        //   $officialspermissiontemp->o_p_checker = isset($value['checker'])?$value['checker']:'';
        //   $officialspermissiontemp->o_p_approver = isset($value['approver'])?$value['approver']:'';
        //   $officialspermissiontemp->update();
        // }
        // }
        return redirect('manageofficials/employeeview')->with('updatemsg', 'Data Updated Successfully!');
    }
    public function deleteemployee($id)
        {
            User::destroy($id);
            return redirect()->back()->with('delmsg', 'Data Deleted Successfully!');
        }



}
