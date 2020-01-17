<?php
namespace App\Http\Controllers\Api;
use App\Brand;
use App\Product;
use App\Ticket;
use App\Customer;
use App\Techsupport;
use App\Branch;
use App\Ticket_Message;
use Auth;
use \App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Customer Controller for Api
 * 
 * @author zildjian <gtrmergillazildjianl@gmail.com>
 * @since 2019.12.31
 */
class CustomerController extends BaseApiController {

    
    /**
     * Default response
     */
    public function login(Request $request)
    {
       
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            
            return response()->json(bobo);
        }
       
    }
    public function index() {
   
        
        
        $id = Auth::guard('customer')->user()->id;
        $aCustomers = Customer::where('id',$id)->get();
        return response()->json($aCustomers);
    
    }

    public function getBrands(){
        $aBrands = Brand::where('status','active')->get();
        return response()->json($aBrands);

    }

    public function getProducts(Request $request){
        $brand = $request->brand;

        $aProducts = Product::with('brands')->where('brand_id','=',$brand)->where('status','available')->get();
        return response()->json($aProducts);
    }

    function ticket(Request $request)
    {
       
        $product = $request->product;
        $aBranches = Branch::where('status','active')->get();
        $aProducts = Product::with('brands')->where('id','=',$product)->get();
        return response()->json($aBranches,$aProducts);
    }
    public function getTickets() {
      
        $id = Auth::guard('customer')->user()->id;
        $aTickets = Ticket::with('products','techsupports')->where('customer_id',$id)->orderBy('created_at','DESC')->get();
        
        return response()->json($aTickets);
    }

    
    public function viewTickets($id) {
      
        $aTickets = Ticket::with('products','techsupports')->where('id',$id)->where('customer_id',Auth::guard('customer')->user()->id)->get();
        $aTicket_messages = Ticket_Message::with('tickets','techsupports')->where('ticket_id',$id)->get();

        return response()->json($aTickets,$aTicket_messages);
        
    }

    
    public function search_ticket(Request $request)
    {
        $search = $request->search;
        $id = Auth::guard('customer')->user()->id;
        $aTickets = Ticket::with('products','techsupports')->where('customer_id',$id)->where('id',$search)->orderBy('created_at','DESC')->paginate(10);

        return response()->json($aTickets);
    }
    public function send_message(Request $request,$id)
    {

        $ticket = Ticket::where('id',$id)->get();
        $ticket_messages = new Ticket_Message();
        $ticket_messages->ticket_id = $id;
        $ticket_messages->sender_customer_id = Auth::guard('customer')->user()->id;
        $ticket_messages->message = $request->message;
        $ticket_messages->recipient_techsupport_id = $ticket->get(0)->techsupport_id;
        $ticket_messages->save();
    

        
    }

    public function send_ticket(Request $request){

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
    $ticket->customer_id = Auth::guard('customer')->user()->id;
    $ticket->product_id = $request->product;
    $ticket->techsupport_id = $techs->get(0)->id;
    $ticket->branch_id = $request->branch;
    $ticket->message = $request->message;
    $ticket->dop = $request->dop;
    $ticket->receipt = $fileNametoStore;
    $ticket->status = 'pending';
    $ticket->save();
    }

}