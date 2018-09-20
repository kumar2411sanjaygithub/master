<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use Illuminate\Support\Facades\DB;
use App\Jobtitles;
use App\RolePermission;
use \Cache;
use App\PermissionList;
use Illuminate\Support\Facades\Redirect;

class AssignPermissionController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id='')
    {

        $role_id = $id;
        $permission_list = PermissionList::orderby('id','asc')->get();
        $permission_array = Permission::get()->toArray();
        $all_permission_id = array_column($permission_array, 'permission_id');
        $role_map_per = RolePermission::leftJoin('permissions', function($join) {
                  $join->on('role_has_permissions.permission_id', '=', 'permissions.id');
                })
                ->where('role_id',$role_id)
                ->get()
                ->toArray();
        $permission_name = array_column($role_map_per, 'name');
        return view('ManageOfficials.assignPermission', compact('permission_list','role_id','all_permission_id','permission_name'));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StoreRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role_id=$request->get_role_id;
        //dd($request->all());
        $delete_role=RolePermission::where('role_id',$role_id)->delete();

        
        if($request->get=='')
        {
            return Redirect::back();
        }
        $total_permission=count($request->get);
        for($i=1;$i<=$total_permission;$i++)
        {
            $permissions = $request->get[$i] ? $request->get[$i] : [];
            //print_r($permissions);
            foreach($permissions as $permission)
            {
                $arr=explode('-',$permission);
                $permission=$arr[0];
                $permissionID=$arr[1];
                $get_permission_data = Permission::where('name',$permission)->first();
                if($get_permission_data)
                {
                    $last_insert_id=$get_permission_data->id;

                    $role_permission=new RolePermission;
                    $role_permission->permission_id=$last_insert_id;
                    $role_permission->role_id=$role_id;
                    $role_permission->save();
                }
                else
                {
                    $permission = Permission::create(['name' => $permission,'permission_id' => $permissionID]);

                    $last_insert_id=$permission->id;

                    $role_permission=new RolePermission;
                    $role_permission->permission_id=$last_insert_id;
                    $role_permission->role_id=$role_id;
                    $role_permission->save();
                }
            }         
        }
        return Redirect::back()->with('success', 'Permission assign successfully.');
    }

    public function all_roles(Request $request)
    {
        // if (! Gate::allows('roles')) 
        // {
        //     return abort(500);
        // }
        $permission_arr=explode(',',$request->permission);
        // print_r($dd);die;
        // $role_exists = DB::table('roles')->where('name',$request->name )->first();
        $get_role_data = Role::where('name',$request->name)->first();

        if($get_role_data)
        {
            $role =  $get_role_data;
            //dd($role);
            $permissions = $permission_arr ? $permission_arr : [];
            $role->givePermissionTo($permissions);
            return redirect()->route('hrms-admin.assignroles.index')->with('success', 'Role Created Successfully.');
        }
        else
        {
            $role = Role::create($request->except(['permission','employeerelation']));
            //dd($role);
            $permissions = $permission_arr ? $permission_arr : [];
            $role->givePermissionTo($permissions);

            return redirect()->route('hrms-admin.assignroles.index')->with('success', 'Role Created Successfully.');
        }
    }

}
