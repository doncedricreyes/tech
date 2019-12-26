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
        return view('customer.home');
    }

    public function service()
    {
     
        $brands = Brand::get();
        $products = Product::with('brands')->get();
        return view('customer.service',['products'=>$products,'brands'=>$brands]);
    }

    function brand(Request $request)
    {
        $brand = $request->brand;

        $products = Product::with('brands')->where('brand_id','=',$brand)->get();
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

 
    $ticket_id = Ticket::orderBy('id','desc')->first();
    $techs = Techsupport::where('status','active')->where('role','techsupport')->where('id','!=',$ticket_id->techsupport_id)->get()->random(1);
    

  

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
        $tickets = Ticket::with('products','customers')->where('customer_id',$id)->orderBy('created_at','DESC')->get();

        return view('customer.index_ticket',['tickets'=>$tickets]);
    }

    public function view_ticket($id)
    {
        $tickets = Ticket::with('products','customers')->where('id',$id)->get();
        $ticket_messages = Ticket_Message::with('tickets','customers','techsupports')->where('ticket_id',$id)->get();
        return view('customer.view_ticket',['tickets'=>$tickets,'ticket_messages'=>$ticket_messages]);
    }

    public function send_message(Request $request,$id)
    {

        $ticket = Ticket::where('id',$id)->get();

        $ticket_messages = new Ticket_Message();
        $ticket_messages->ticket_id = $id;
        $ticket_messages->sender_customer_id = Auth::user()->id;
        $ticket_messages->message = $request->message;
        $ticket_messages->recipient_techsupport_id = $ticket->get(0)->customer_id;
        $ticket_messages->save();
        $request->session()->flash('alert-success', 'Message Successfully Sent!');
        return redirect()->back();
    }
}