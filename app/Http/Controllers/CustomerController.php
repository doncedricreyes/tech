<?php

namespace App\Http\Controllers;
use App\Brand;
use App\Product;
use App\Ticket;
use App\Customer;
use App\Techsupport;
use App\Branch;
use App\Ticket_Message;
use Hash;
use Auth;
use Image;
use Excel;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    public function home()
    {
        $id = Auth::user()->id;
        $tickets = Ticket::with('products','customers')->where('customer_id',$id)->orderBy('created_at','DESC')->paginate(10);

        return view('customer.index_ticket',['tickets'=>$tickets]);
    }

    public function service()
    {
     
        $brands = Brand::where('status','active')->get();
        $products = Product::with('brands')->get();
        return view('customer.service',['products'=>$products,'brands'=>$brands]);
    }

    function brand(Request $request)
    {
        $brand = $request->brand;

        $products = Product::with('brands')->where('brand_id','=',$brand)->where('status','available')->get();
        return view('customer.product',['products'=>$products]);
    }

    function ticket(Request $request)
    {
        $branches = Branch::where('status','active')->get();
        $product = $request->product;
        $products = Product::with('brands')->where('id','=',$product)->get();
        return view('customer.ticket',['products'=>$products,'branches'=>$branches]);
    }

    function send_ticket(Request $request)
    {
        $input = request()->validate([

            'receipt' => 'mimes:jpeg,jpg,png,bmp,gif,tif,tiff|max:50000|',

       ], [

       ]);

       if ($request->hasFile('receipt')) {
        $filenameWithExt = $request->file('receipt')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('receipt')->getClientOriginalExtension();
        $fileNametoStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('receipt')->storeAs('public/images',$fileNametoStore);
        
    }

    $products = Product::with('brands')->where('id',$request->product)->get();
 
    $ticket_id = Ticket::orderBy('id','desc')->first();
    $techs = Techsupport::where('status','active')->where('role','techsupport')->where('id','!=',$ticket_id->techsupport_id)->where('brand_id',$products->get(0)->brand_id)->get()->random(1);
    

  

    $ticket = new Ticket();
    $ticket->customer_id = Auth::user()->id;
    $ticket->product_id = $request->product;
    $ticket->techsupport_id = $techs->get(0)->id;
    $ticket->branch_id = $request->branch;
    $ticket->message = $request->message;
    $ticket->dop = $request->dop;
    $ticket->receipt = $fileNametoStore;
    $ticket->status = 'pending';
    $ticket->save();
    $request->session()->flash('alert-success', 'Ticket Successfully Submitted!');
    return redirect('/customer/service/tickets');
  
    }

    function index_ticket()
    {
        $id = Auth::user()->id;
        $tickets = Ticket::with('products','customers')->where('customer_id',$id)->orderBy('created_at','DESC')->paginate(10);

        return view('customer.index_ticket',['tickets'=>$tickets]);
    }

    public function view_ticket($id)
    {
        $tickets = Ticket::with('products','customers')->where('id',$id)->where('customer_id',auth::user()->id)->get();
        $ticket_messages = Ticket_Message::with('tickets','customers','techsupports')->where('ticket_id',$id)->get();
        return view('customer.view_ticket',['tickets'=>$tickets,'ticket_messages'=>$ticket_messages]);
    }

    public function search_ticket(Request $request)
    {
        $search = $request->search;
        $id = Auth::user()->id;
        $tickets = Ticket::with('products','customers')->where('customer_id',$id)->where('id',$search)->orderBy('created_at','DESC')->paginate(10);
        if($tickets->isEmpty()){
            $request->session()->flash('alert-danger', 'Ticket not found!');
            return view('customer.index_ticket',['tickets'=>$tickets]);
    
        }
        else{
            $request->session()->flash('alert-success', 'Ticket found!');
            return view('customer.index_ticket',['tickets'=>$tickets]);
        }

      
    }
    public function send_message(Request $request,$id)
    {

        $ticket = Ticket::where('id',$id)->get();
        $ticket_messages = new Ticket_Message();
        $ticket_messages->ticket_id = $id;
        $ticket_messages->sender_customer_id = Auth::user()->id;
        $ticket_messages->message = $request->message;
        $ticket_messages->recipient_techsupport_id = $ticket->get(0)->techsupport_id;
        $ticket_messages->save();
    
      
        return redirect()->back();
        
    }

    public function account()
    {
        $customers = Customer::where('id',auth::user()->id)->get();
        return view('customer.account',['customers'=>$customers]);
    }

    public function account_update(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'email' => 'required|',
            'name' => 'required|',
            'contact' => 'required|',
            'address' => 'required|',
        ], [
  

        ]);
       
        $id = Auth::user()->id;
        $customers = Customer::where('id',$id)->get();
     
        if (Hash::check($request->old_password, $customers->get(0)->password)) {
            $customer = Customer::find($id);
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->contact = $request->contact;
            $customer->address = $request->address;
            $customer->password = Hash::make($request['password']);
            $customer->save();
            $request->session()->flash('alert-success', 'Account successfully updated!');
            return redirect()->back();
        }
        else{
            $request->session()->flash('alert-danger', 'Account not updated!');
            return redirect()->back();
        }
     
     
    }


  
}