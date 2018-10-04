<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Role;
use App\Department;
use Carbon\Carbon;
use DB;
use App\User;
use App\Employeeupdatestatus;
use Validator;
use Illuminate\Support\Facades\Redirect;

//  Approve Request module created by AKS

class EmployeeApprovalController extends Controller
{
	public function approveemployeeview()
	{
        $employeeData = User::orderBy('created_at','desc')->where('id','!=',1)->whereIn('emp_app_status',array(0, 1, 2))->paginate(15);
        return view('ApprovalRequest.employee.approvenewemployee',compact('employeeData','role'));
  }

	public function approvenew($id)
	{
		     $employee = User::find($id);
         $employee->emp_app_status = '1';
         $employee->update();
         return redirect()->back()->with('updatemsg', 'Approved Successfully!');
	}

	public function rejectnew($id)
	{
		     $employee = User::find($id);
         $employee->emp_app_status = '2';
         $employee->update();
         return redirect()->back()->with('updatemsg', 'Rejected Successfully!');
	}
  public function newEmployeeApp(Request $request,$tag='')
    {
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved')
        {
          foreach($array as $id)
           {
            $employee = User::find($id);
            $employee->emp_app_status = '1';
            $employee->update();
            }
            return Redirect::back()->with('updatemsg', 'Approved Successfully!');
        }
          elseif ($tag=='Rejected')
           {
            foreach($array as $id)
            {
              $employee = User::find($id);
              $employee->emp_app_status = '2';
              $employee->update();
            }
            return Redirect::back()->with('updatemsg', 'Rejected Successfully.');
        }

    }

	 public function viewexistingemployee()
        {
          $keys=array('mob_number'=>'Mobile Number','employee_id'=>'Employee Id','name'=>'Employee Name','email'=>'Email','contact_number'=>'Contact No.','username'=>'User Name','password'=>'Password','role'=>'Role','designation'=>'Designation','department_id'=>'Department','line1'=>'Address Line 1','line2'=>'Address Line 2','country'=>'Country','state'=>'State','city'=>'City','pin_code'=>'Pin Code','comm_mob'=>'Communication Number','comm_telephone'=>'Telephones','telephone_number'=>'Telephone Number');
          $employeeData = Employeeupdatestatus::whereIn('approve_status',array(0,1,2))->latest()->paginate(15);
          $state_data = array_keys(\App\Common\StateList::get_states());          
          return view('ApprovalRequest.employee.existingemployee',compact('employeeData','keys','state_data'));
        }

    public function existingApprove($id)
    {
    	$updates = Employeeupdatestatus::find($id);
      $user = User::find($updates->employee_id);
      $keyname = $updates->keyname;
        if($keyname == 'department_id')
        {
         
          $updates->value = Department::where('depatment_name', $updates->value)->pluck('id');
          $updates->value=$updates->value[0];
        }
        if($keyname == 'role')
        {
          $updates->value = Role::where('id', $updates->value)->pluck('name'); 
          $updates->value=$updates->value[0];
        }
         if($keyname == 'state')
         {
          $valueble = $updates->value;
          $state_list = \App\Common\StateList::get_states();
            foreach ($state_list as $key => $value)
             {
                if($value['name'] == $valueble)
                {
                $updates->value = $key;
                }
            }
          }
          $user->$keyname = $updates->value;
          $user->update();
          $updates->approve_status = '1';
          $updates->update();
        return redirect()->back()->with('updatemsg', 'Approved Successfully!');
    }

    public function existingReject($id)
    {
    	   $updates = Employeeupdatestatus::find($id);
         $updates->approve_status = '2';
         $updates->update();
         return redirect('existemployeeclients')->with('updatemsg', 'Rejected Successfully!');
    }

    public function existsEmployeeApp(Request $request,$tag='')
    {
        $approvalstatus_id=$request['selected_status'];
        $array=explode(',',$approvalstatus_id);
        if($tag=='Approved')
        {
          foreach($array as $id)
          {
                  $updates = Employeeupdatestatus::find($id);
                  $user = User::find($updates->employee_id);
                  $keyname = $updates->keyname;
                  if($keyname == 'department_id')
                  {
                    $updates->value = Department::where('depatment_name', $updates->value)->pluck('id');
                    $updates->value=$updates->value[0];
                  }
                  if($keyname == 'state')
                  {
                    $valueble = $updates->value;
                    $state_list = \App\Common\StateList::get_states();
                      foreach ($state_list as $key => $value)
                       {
                          if($value['name'] == $valueble)
                          {
                          $updates->value = $key;
                          }
                       }
                  }
                  if($updates->value!='')
                  {
                  $user->$keyname = @$updates->value;
                  $user->update();
                  }
                  $updates->approve_status = '1';
                  $updates->update();
          }
            return Redirect::back()->with('updatemsg', 'Approved Successfully!');
        }
          elseif ($tag=='Rejected')
           {
             foreach($array as $id)
             {
             $updates = Employeeupdatestatus::find($id);
             $updates->approve_status = '2';
             $updates->update();
            }
            return Redirect::back()->with('updatemsg', 'Rejected Successfully.');
          }
    }
}
