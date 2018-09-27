<?php

namespace App\Http\Controllers;

//use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use App\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\PermissionList;
use App\Roles;
use App\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = Roles::all();
        $department = Department::orderBy('depatment_name','Desc')->get();
        return view('ManageOfficials.role_list', compact('roles','department'));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $department = Department::orderBy('depatment_name','Desc')->get();
        return view('ManageOfficials.role_create', compact('department'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StoreRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'department' => 'required',
        ]);

 if(Auth::guard('web')->check()){
    $gurad_name='web';
 }
 elseif(Auth::guard('client')->check())
 {
    $gurad_name='client';
 }

        $role_exists = Role::where('name',$request->input('name'))->where('department_id',$request->input('department'))->where('guard_name',$gurad_name)->first();
        if($role_exists)
        {
            return redirect()->route('roles.index')->with('error', 'Role already exists on this department.');
        }
        else
        {

        $login_user=Auth::user();
        $role = new Role;
        $role->name = $request->input('name');
        $role->department_id = $request->input('department');
        $role->guard_name = $gurad_name;
        $role->created_by = $login_user['id'];
        $role->save();

        return redirect()->route('roles.index')->with('success','Role created successfully');
        }
    }


    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::orderBy('depatment_name','Desc')->get();
        $role = Role::findOrFail($id);
        //
        return view('ManageOfficials.role_create', compact('role', 'department'));
    }

    /**
     * Update Role in storage.
     *
     * @param  \App\Http\Requests\UpdateRolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'department' => 'required',
        ]);

 if(Auth::guard('web')->check()){
    $gurad_name='web';
 }
 elseif(Auth::guard('client')->check())
 {
    $gurad_name='client';
 }

        $role_exists = Role::where('name',$request->input('name'))->where('department_id',$request->input('department'))->where('guard_name',$gurad_name)->where('id','!=',$id)->first();
        if($role_exists)
        {
            return redirect()->route('roles.index')->with('error', 'Role already exists on this department.');
        }
        else
        {

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->department_id = $request->input('department');
        $role->save();
        //print_r($role);
        //dd('asdf');
        return redirect()->route('roles.index')->with('success','Role updated successfully');
        }



    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success','Role deleted successfully');
    }

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Role::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
