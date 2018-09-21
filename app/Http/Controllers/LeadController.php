<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Datatables;
use App\PermissionList;
use App\Lead;
use App\LeadSource;
use App\Industry;
use App\Product;
use App\User;
use App\Task;
use App\Client;
use App\LeadEmail;
use App\LeadProduct;
use App\TraderMail;
use Mail;
use App\LeadCRN;
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
        $user = User::where('id','!=',1)->where('emp_app_status',1)->orderBy('name','asc')->get();
        //dd($user);
        $leadsource = LeadSource::orderBy('name','asc')->get();
        $industry = Industry::orderBy('industry_name','asc')->get();
        $product = Product::select('*')->get();
        
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
            'company_name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:50',
            'product' => 'required',
            'contact_person' => 'required|regex:/^[a-zA-Z ]+$/u|max:50',
            'contact_number' => 'required|digits:10',
            'email_id' => 'required',
            'add_line1' => 'required|max:200',
            'add_line2' => 'nullable|max:200',
            'quantum' => 'nullable|regex:/^[0-9]+$/',
            'add_country' => 'required',
            'add_state' => 'required',
            'add_city' => 'required|regex:/^[a-zA-Z ]+$/u|max:50',
            'add_pincode' => 'required|min:4|max:8|not_in:0',
            //'contact_number' => 'nullable|digits:10',

        ]);

        // $last = Lead::orderBy('id', 'desc')->get();
        // if ($last) {
        //     $lead_id=count($last)+1;
        // }else{
        //     $lead_id = 1;
        // }
        //
        //  $leadID='L-'.str_pad($lead_id, 4, '0', STR_PAD_LEFT)."";

        if(request('lead_owner')!='')
        {
            $lead_owner=request('lead_owner');
        }
        else
        {
            $user = auth()->user();
            $lead_owner=$user->id;
        }

        $lead = new Lead;

        $lead->company_name = request('company_name');
        $lead->product = request('product');
        $lead->contact_person = request('contact_person');
        $lead->contact_number = request('contact_number');
        $lead->email_id = request('email_id');
        $lead->industry = request('industry');
        $lead->lead_owner = $lead_owner;
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
        $num = $lead->id;

        $leadId =  $this->getSequence($num);
        
        $lead->leadID = $leadId;
        $lead->update();
       

        return redirect()->route('lead.index')->with('success', 'Lead Added Successfully.');
    }

    
    function getSequence($num) {
     return str_pad($num, 4, '1000', STR_PAD_LEFT);

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
        $user = User::where('id','!=',1)->where('emp_app_status',1)->orderBy('name','asc')->get();
        $leadsource = LeadSource::orderBy('name','asc')->get();
        $industry = Industry::orderBy('industry_name','asc')->get();
        $product = Product::orderBy('id','asc')->get();
        $tasks = Task::orderBy('id','desc')->where('lead_id',$id)->paginate(10);
        $leadProduct = LeadProduct::orderBy('id','desc')->where('lead_id',$id)->paginate(10);
        $leadProduct_arr = LeadProduct::where('lead_id',$id)->get()->toArray();
        $lead_keys=array_column($leadProduct_arr, 'product_id');
        $leadEmail = LeadEmail::orderBy('id','desc')->where('lead_id',$id)->paginate(10);

        $getcrn_info=LeadCRN::where('lead_id',$id)->where('product_id',$leads->product)->where('crn_no','!=','')->first();

        $all_crn_info=LeadCRN::where('lead_id',$id)->where('product_id','!=','')->where('crn_no','!=','')->get()->toArray();
        $print_crn=array_column($all_crn_info, 'product_id');

        return view('crm.edit', compact('leads','user','leadsource','industry','product','tasks','leadProduct','lead_keys','leadEmail','print_crn','getcrn_info'));
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
            'company_name' => 'required|regex:/^[a-zA-Z ]+$/u|max:50',
            'contact_person' => 'nullable|regex:/^[a-zA-Z ]+$/u|max:50',
            'contact_number'=>'required|regex:/^[0-9]{10}$/',
            'add_line1' => 'required|max:200',
            'add_line2' => 'nullable|max:200',
            'add_country' => 'required',
            'add_state' => 'required',
            'add_city' => 'required|regex:/^[a-zA-Z ]+$/u|max:50',
            'add_pincode' => 'required|min:4|max:8|not_in:0',
            'contact_number' => 'nullable|digits:10',

        ]);
        if(request('lead_owner')!='')
        {
            $lead_owner=request('lead_owner');
        }
        else
        {
            $user = auth()->user();
            $lead_owner=$user->id;
        }
        $lead = Lead::find($id);
        $lead->company_name = request('company_name');
        //$lead->product = request('product');
        $lead->contact_person = request('contact_person');
        $lead->contact_number = request('contact_number');
        $lead->email_id = request('email_id');
        $lead->industry = request('industry');
        $lead->lead_owner = $lead_owner;
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
    public function generateCrn($id='',$c_id='')
    {

        $lead_info = Lead::findOrFail($id);
        $password = str_random(10);

        if($lead_info->product==$c_id)
        {
            $client = new Client;
            $client->company_name = $lead_info->company_name;
            $client->name = $lead_info->contact_person;
            $client->email = $lead_info->email_id;
            $client->password = Hash::make($password);
            $client->reg_line1 = $lead_info->add_line1;
            $client->reg_line2 = $lead_info->add_lin2;
            $client->reg_country = $lead_info->add_country;
            $client->reg_state = $lead_info->add_state;
            $client->reg_city = $lead_info->add_city;
            $client->reg_pin = $lead_info->add_pincode;
            $client->reg_mob = $lead_info->contact_number;
            $client->client_app_status = 0;
            $client->save();

            // Create Unique CRN no.
            $cid = $client->id;
            $crn_no = 'CRN00000'.$cid;
            $insertCRN_no=Client::find($cid);
            $insertCRN_no->crn_no= $crn_no;
            $insertCRN_no->save();

            // insert Crn information to other table
            $data = array(array('lead_id'=>$lead_info->id,'crn_no'=>$crn_no,'product_id'=>$lead_info->product));
            $insert_leadcrn_no=LeadCRN::insert($data);

            //For mail password and username send
            $dateName = date('d-M-Y');
           $trader_mail = TraderMail::select('email_cc','email_bcc','mail_from')->get()->toArray();
            $client_mail = Client::select('email','company_name')->where('id', $cid)->get()->toArray();

           $headers  = "MIME-Version: 1.0\r\n";
           $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
           $clientname = $client_mail[0]['company_name'];
           //dd($clientname);
           $out = Mail::send('email.credential',array('crn_no'=>$crn_no,'password'=>$password,'dateName'=> $dateName,'clientname' => $lead_info->company_name) , function($message) use ($client_mail,$trader_mail,$headers) {
           foreach ($client_mail as $key => $user) {
              $message->to($user['email'], $user['company_name']);
            }
              $message->subject('CRM Login Details ');
                foreach($trader_mail as $key => $email){
                  $message->cc($email['email_cc']);
                  $message->bcc($email['email_bcc']);
                  $message->from($email['mail_from']);
                }
              });
        }
        else
        {
            $convert=LeadProduct::where(['lead_id'=>$id,'product_id'=>$c_id])->update(['product_converted' => 1]);

        }
        return redirect()->route('lead.index')->with('success', 'Client CRN information generate Successfully.');

    }

}
