<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\PermissionList;

class PermissionListController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $permissions = PermissionList::all();

        return view('ManageOfficials.permission_list', compact('permissions'));
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('ManageOfficials.permission_store');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $permission_exists = DB::table('tbl_permissions')->where('permission_name',$request->permission_name )->first();

        if($permission_exists)
        {
            return redirect()->route('permissionlist.index')->with('error', 'Permission Already Exists.');
        }
        else
        {
            $permission = new PermissionList;
            $permission->permission_name = request('permission_name');
            $permission->slug = request('slug');
            $permission->description = request('description');
            $permission->save();   
            return redirect()->route('permissionlist.index')->with('success', 'Permission Added Successfully.');
        }
    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $permissions = PermissionList::findOrFail($id);

        return view('ManageOfficials.permission_store', compact('permissions'));
    }

    /**
     * Update Permission in storage.
     *
     * @param  \App\Http\Requests\UpdatePermissionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $permission = PermissionList::find($id);
        $permission->permission_name = request('permission_name');
        $permission->slug = request('slug');
        $permission->description = request('description');
        $permission->save();

        return redirect()->route('permissionlist.index')->with('success', 'Permission Updated Successfully.');
    }


    /**
     * Remove Permission from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $permission = PermissionList::findOrFail($id);
        $permission->delete();

        return redirect()->route('permissionlist.index')->with('success', 'Permission Deleted Successfully.');
    }

    /**
     * Delete all selected Permission at once.
     *
     * @param Request $request
     */

}
