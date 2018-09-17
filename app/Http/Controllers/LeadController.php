<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Datatables;
use App\PermissionList;
use App\Lead;
use App\LeadSource;
use App\Industry;
use App\Product;
use App\User;
use App\Task;
use App\LeadEmail;
use App\LeadProduct;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;


class LeadController extends Controller
{
    /**
     * Display a listing of Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $leads = Lead::paginate(10);

        return view('crm.index', compact('leads'));
    }

    /**
     * Show the form for creating new Permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where('id','!=',1)->orderBy('name','asc')->get();
        $leadsource = LeadSource::orderBy('name','asc')->get();
        $industry = Industry::orderBy('industry_name','asc')->get();
        $product = Product::orderBy('product_name','asc')->get();
        return view('crm.create', compact('user','leadsource','industry','product'));
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param  \App\Http\Requests\StorePermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
            'contact_person' => 'nullable|regex:/^[a-zA-Z]+$/u|max:50',
            'add_line1' => 'required|max:200',
            'add_line2' => 'nullable|max:200',
            'add_country' => 'required',
            'add_state' => 'required',
            'add_city' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
            'add_pincode' => 'required|min:4|max:8|not_in:0',
            'contact_number' => 'nullable|digits:10',
        ]);

        $last = Lead::orderBy('id', 'desc')->get();        
        if ($last) {
            $lead_id=count($last)+1;
        }else{
            $lead_id = 1;
        }

         $leadID='L-'.str_pad($lead_id, 4, '0', STR_PAD_LEFT)."";

        $lead = new Lead;
        $lead->leadID = $leadID;
        $lead->company_name = request('company_name');
        $lead->product = request('product');
        $lead->contact_person = request('contact_person');
        $lead->contact_number = request('contact_number');
        $lead->email_id = request('email_id');
        $lead->industry = request('industry');
        $lead->lead_owner = request('lead_owner');
        $lead->lead_source = request('lead_source');
        $lead->quantum = request('quantum');
        $lead->state = request('state');
        $lead->discom = request('discom');
        $lead->voltage = request('voltage');
        $lead->remarks = request('remarks');
        $lead->add_line1 = request('add_line1');
        $lead->add_lin2 = request('add_lin2');   
        $lead->add_country = request('add_country');
        $lead->add_state = request('add_state');
        $lead->add_city = request('add_city');
        $lead->add_pincode = request('add_pincode');                                
        $lead->save();  

        return redirect()->route('lead.index')->with('success', 'Lead Added Successfully.');
    }


    /**
     * Show the form for editing Permission.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leads = Lead::where('id',$id)->first();
        $user = User::where('id','!=',1)->orderBy('name','asc')->get();
        $leadsource = LeadSource::orderBy('name','asc')->get();
        $industry = Industry::orderBy('industry_name','asc')->get();
        $product = Product::orderBy('product_name','asc')->get();
        $tasks = Task::orderBy('id','desc')->where('lead_id',$id)->paginate(10);
        $leadProduct = LeadProduct::orderBy('id','desc')->where('lead_id',$id)->paginate(10);
        $leadProduct_arr = LeadProduct::where('lead_id',$id)->get()->toArray();
        $lead_keys=array_column($leadProduct_arr, 'product_id');
        $leadEmail = LeadEmail::orderBy('id','desc')->where('lead_id',$id)->paginate(10);


        return view('crm.edit', compact('leads','user','leadsource','industry','product','tasks','leadProduct','lead_keys','leadEmail'));
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
        
        $this->validate($request, [
            'company_name' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
            'contact_person' => 'nullable|regex:/^[a-zA-Z]+$/u|max:50',
            'add_line1' => 'required|max:200',
            'add_line2' => 'nullable|max:200',
            'add_country' => 'required',
            'add_state' => 'required',
            'add_city' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
            'add_pincode' => 'required|min:4|max:8|not_in:0',
            'contact_number' => 'nullable|digits:10',
        ]);

        $lead = Lead::find($id);
        $lead->company_name = request('company_name');
        $lead->product = request('product');
        $lead->contact_person = request('contact_person');
        $lead->contact_number = request('contact_number');
        $lead->email_id = request('email_id');
        $lead->industry = request('industry');
        $lead->lead_owner = request('lead_owner');
        $lead->lead_source = request('lead_source');
        $lead->quantum = request('quantum');
        $lead->state = request('state');
        $lead->discom = request('discom');
        $lead->voltage = request('voltage');
        $lead->remarks = request('remarks');
        $lead->add_line1 = request('add_line1');
        $lead->add_lin2 = request('add_lin2');   
        $lead->add_country = request('add_country');
        $lead->add_state = request('add_state');
        $lead->add_city = request('add_city');
        $lead->add_pincode = request('add_pincode');                                
        $lead->save();  

        return redirect()->route('lead.index')->with('success', 'Lead Updated Successfully.');
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
    public function taskadd(Request $request)
    {
        // Convert Date Format
        $commerce_date = strtr(request('due_date'), '/', '-');
        $new_commerce_date = date("Y-m-d", strtotime($commerce_date));

        $task = new Task;
        $task->lead_id = request('lead_id');
        $task->subject = request('subject');
        $task->status = request('status');
        $task->due_date = $new_commerce_date;
        $task->owner = request('owner');                             
        $task->save();  

        return Redirect::back()->with('success', 'Task added successfully.');
    }
    public function taskdelete($id)
    {
        
        $task = Task::findOrFail($id);
        $task->delete();

        return Redirect::back()->with('success', 'Task deleted successfully.');
    }
    public function taskupdate(Request $request,$id='')
    {
        // Convert Date Format
        $commerce_date = strtr(request('due_date'), '/', '-');
        $new_commerce_date = date("Y-m-d", strtotime($commerce_date));

        $task = Task::find($id);
        $task->subject = request('subject');
        $task->status = request('status');
        $task->due_date = $new_commerce_date;
        $task->owner = request('owner');                             
        $task->save();  

        return Redirect::back()->with('success', 'Task updated successfully.');
    }
    public function productadd(Request $request)
    {
        
        $product = new LeadProduct;
        $product->lead_id = request('lead_id');
        $product->product_id = request('product_id');
        $product->save();  

        return Redirect::back()->with('success', 'Product added successfully.');
    }
    public function leadproduct_delete($id)
    {
        
        $product = LeadProduct::findOrFail($id);
        $product->delete();

        return Redirect::back()->with('success', 'Product deleted successfully.');
    }
    public function lead_email_add(Request $request)
    {
        $login_user=Auth::user();

      if(isset(request()->attached))
        {
            $imageName = time().'.'.request()->attached->getClientOriginalName();
            request()->attached->move(public_path('files/'), $imageName);           
        }
        else
        {
            $imageName = "";
        }

        $email = new LeadEmail;
        $email->lead_id = request('lead_id');
        $email->send_by = $login_user['email'];
        $email->recieved_by = request('recieved_by');
        $email->subject = request('subject');
        $email->message = request('editor1');   
        $email->attached = $imageName;                           
        $email->save();  

        return Redirect::back()->with('success', 'Email Send successfully.');
    }
    public function lead_email_delete($id)
    {
        
        $email = LeadEmail::findOrFail($id);
        $email->delete();

        return Redirect::back()->with('success', 'Email deleted successfully.');
    }
}
