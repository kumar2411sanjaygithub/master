<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\TaskStatus;

class TaskStatusController extends Controller
{
    public function index()
    {
        $taskstatus = TaskStatus::all();

        return view('crm-master.taskstatus.index', compact('taskstatus'));
    }

    public function create()
    {

        return view('crm-master.taskstatus.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            't_status' =>'required'
        ]); 
        // For Insert Data
        $taskstatus = new TaskStatus;
        $taskstatus->task_status = Input::get('task_status');
        $taskstatus->save();

        return redirect()->route('crm-master.taskstatus.index')->with('success', 'Status Added Successfully.');
    }

    public function edit($id)
    {
        $taskstatus = TaskStatus::findOrFail($id);

        return view('crm-master.taskstatus.edit', compact('taskstatus'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'task_status' =>'required'
        ]); 
        // For Update TaskStatus
        $taskstatus = TaskStatus::find($id);
        $taskstatus->task_status = Input::get('task_status');
        $taskstatus->save();        

        return redirect()->route('crm-master.taskstatus.index')->with('success', 'Status Updated Successfully.');
    }

    public function destroy($id)
    {
        $taskstatus = TaskStatus::findOrFail($id);
        $taskstatus->delete();

        return redirect()->route('crm-master.taskstatus.index')->with('success', 'Status Deleted Successfully.');
    }

}
