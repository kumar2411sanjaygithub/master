<?php

namespace tptcl\iex\Controller;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use Illuminate\Support\Facades\DB;
use Tptcl\Iex\Tasknew;
use View;
use Illuminate\Support\Facades\Auth;
use \Cache;
use Illuminate\Support\Facades\Redirect;

class TptclIexController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $login_employee=Auth::user();
        //dd($login_employee);
        //return redirect()->route('task.index');
        $permissions=Tasknew::paginate(15);
        //dd($task_list);
        return View::make('iex::index',compact('permissions')); 


    }
        public function store(Request $request)
    {
        
        $this->validate($request, [
            'permission_name' => 'required|unique:tbl_permissions,permission_name',
        ]);
        $permission_exists = DB::table('tbl_permissions')->where('permission_name',$request->permission_name )->first();

        if($permission_exists)
        {
            return redirect()->back()->with('error', 'Permission Already Exists.');
        }
        else
        {
            $permission = new Tasknew;
            $permission->permission_name = request('permission_name');
            $permission->slug = request('slug');
            $permission->description = request('description');
            $permission->save();   
            return redirect()->back()->with('success', 'Permission Assigned Successfully.');
        }
    }
    public function edit($id)
    {
    
        $permissions = Tasknew::findOrFail($id);

        return View::make('iex::create',compact('permissions'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'permission_name' => 'required',
        ]);
        $permission = Tasknew::find($id);
        $permission->permission_name = request('permission_name');
        $permission->slug = request('slug');
        $permission->description = request('description');
        $permission->save();

        return redirect()->route('task.index')->with('success', 'Permission Updated Successfully.');
    }
    public function destroy($id)
    {
        
        $permission = Tasknew::findOrFail($id);
        $permission->delete();

        return redirect()->back()->with('success', 'Permission Deleted Successfully.');
    }


}
