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
use Illuminate\Support\Facades\Auth;
use App\PermissionList;
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

        $roles = Role::all();

        return view('ManageOfficials.role_list', compact('roles'));
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
            'name' => 'required|unique:roles,name',
            'department' => 'required',
        ]);

        $login_user=Auth::user();
        $role = Role::create(['name' => $request->input('name'),'department_id' => $request->input('department'),'created_by' => $login_user['id']]);

        return redirect()->route('roles.index')->with('success','Role created successfully');
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
            'name' => 'required|unique:roles,name',
            'department' => 'required',
        ]);
        
        $role = Role::findOrFail($id);
        $role->update(['name' => $request->input('name'),'department_id' => $request->input('department')]);

        return redirect()->route('roles.index')->with('success','Role updated successfully');
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
