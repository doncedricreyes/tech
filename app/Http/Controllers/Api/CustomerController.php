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
    public function index() {
        $id = Auth::user()->id;
        $aTickets = Ticket::with('products','customers')->where('customer_id',$id)->orderBy('created_at','DESC')->get();
        
        return response()->json($aTickets);
       
    }

    public function getBrands(){
        $aBrands = Brand::get();
        return response()->json($aBrands);

    }

    public function getProducts(Request $request){
        $brand = $request->brand;

        $aProducts = Product::with('brands')->where('brand_id','=',$brand)->get();
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
      
        $id = Auth::user()->id;
        $aTickets = Ticket::with('products','customers')->where('customer_id',$id)->orderBy('created_at','DESC')->get();
        
        return response()->json($aTickets);
    }

    
    public function viewTickets($id) {
      
        $aTickets = Ticket::with('products','customers')->where('id',$id)->where('customer_id',auth::user()->id)->get();
        $aTicket_messages = Ticket_Message::with('tickets','customers','techsupports')->where('ticket_id',$id)->get();

        return response()->json($aTickets,$aTicket_messages);
        
    }

    
    public function search_ticket(Request $request)
    {
        $search = $request->search;
        $id = Auth::user()->id;
        $aTickets = Ticket::with('products','customers')->where('customer_id',$id)->where('id',$search)->orderBy('created_at','DESC')->paginate(10);

        return response()->json($aTickets);
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
    

        
    }

    public function send_ticket(){

    }

}