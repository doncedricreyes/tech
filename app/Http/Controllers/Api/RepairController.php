<?php
namespace App\Http\Controllers\Api;
use Auth;
use App\Ticket_Repair;
use App\Repair_Message;
use App\Repair;
use App\Ticket;
use App\Inventory;
use App\Category;
use App\Order;
use App\Request_Inventory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RepairController extends BaseApiController {

    public function index() {
        return response('this is working');
    }

    public function getRepair()
    {
        $aTicket_repairs = Ticket_Repair::with('tickets','repairs')->where('repair_id',Auth::user()->id)->orderBy('created_at','asc')->paginate(10);
        return response(json_encode($aTicket_repairs), 200, $this->aHeaders);
    }

    public function viewRepair($id)
    {
        $aTicket_repairs = Ticket_Repair::with('tickets','repairs')->where('ticket_id',$id)->where('repair_id',auth::user()->id)->get();
        $aRepair_messages = Repair_Message::with('repairs','tickets','techsupports')->where('ticket_id',$id)->get();
        return response(json_encode($aTicket_repairs,$aRepair_messages), 200, $this->aHeaders);
    }

    public function getOrder()
    {
        $aOrders = Order::with('inventory','repairs')->where('repair_id',auth::user()->id)->orderBy('created_at','asc')->get();
        return response(json_encode($aOrders), 200, $this->aHeaders);
    }

    public function getRequest()
    {
        $aRequest_inventory = Request_Inventory::with('repairs')->where('repair_id',auth::user()->id)->orderBy('created_at','asc')->get();
        return response(json_encode($aRequest_inventory), 200, $this->aHeaders);
    }
  
    public function inventory(Request $request)
    {
        $cat = $request->category;
        $aInventory = Inventory::with('category')->where('category_id',$cat)->get();
        $aCategory = Category::get();
        return response(json_encode($aInventory), 200, $this->aHeaders);
    }

    
    public function search_repair(Request $request)
    {
        $search = $request->search;
        $aTicket_repairs = Ticket_Repair::with('tickets','repairs')->where('ticket_id',$search)->where('repair_id',Auth::user()->id)->orderBy('created_at','asc')->paginate(10);

        return response(json_encode($aTicket_repairs), 200, $this->aHeaders);
    }

    public function search_order(Request $request)
    {
        $search = $request->search;
        $inventory = Inventory::where('name',$search)->get();
        $aOrders = Order::with('inventory','repairs')->where('inventory_id',$inventory->get(0)->id)->where('repair_id',auth::user()->id)->orderBy('created_at','asc')->paginate(10);
        return response(json_encode($aOrders), 200, $this->aHeaders);
    }
    
    public function search_request(Request $request)
    {
        $search = $request->search;
        $aRequest_inventory = Request_Inventory::with('repairs')->where('name',$search)->orderBy('created_at','asc')->paginate(10);
        return response(json_encode($aRequest_inventory), 200, $this->aHeaders);

    }
}