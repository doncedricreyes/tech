<?php

namespace App\Http\Controllers;
use Hash;
use Auth;
use Image;
use Excel;
use App\Ticket_Repair;
use App\Repair_Message;
use App\Repair;
use App\Ticket;
use App\Inventory;
use App\Category;
use App\Order;
use App\Request_Inventory;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:repair');
    }

    public function home()
    {
        return view('repair.home');
    }

    public function repairs()
    {
        $ticket_repairs = Ticket_Repair::with('tickets','repairs')->where('repair_id',Auth::user()->id)->orderBy('created_at','asc')->paginate(10);

        return view('repair.repair',['ticket_repairs'=>$ticket_repairs]);
    }

    public function repair_message($id)
    {
        $ticket_repairs = Ticket_Repair::with('tickets','repairs')->where('ticket_id',$id)->get();
        $repair_messages = Repair_Message::with('repairs','tickets','techsupports')->where('ticket_id',$id)->get();
        return view('repair.message',['repair_messages'=>$repair_messages,'ticket_repairs'=>$ticket_repairs]);
    }

    public function send_repair_message(Request $request,$id)
    {

        $ticket = Ticket::where('id',$id)->get();

        $repair_messages = new Repair_Message();
        $repair_messages->ticket_id = $id;
        $repair_messages->sender_repair_id = Auth::user()->id;
        $repair_messages->message = $request->message;
        $repair_messages->recipient_techsupport_id = $ticket->get(0)->techsupport_id;
        $repair_messages->save();
        $request->session()->flash('alert-success', 'Message Successfully Sent!');
        return redirect()->back();
    }

    public function inventory(Request $request)
    {
        $cat = $request->category;
        $inventory = Inventory::with('category')->where('category_id',$cat)->get();
        $category = Category::get();
  
        return view('repair.inventory',['category'=>$category,'inventory'=>$inventory]);
    }

    public function order($id, Request $request)
    {
        $order = new Order();
        $order->inventory_id = $id;
        $order->repair_id = auth::user()->id;
        $order->qty = $request->qty;
        $order->save();

        $inventory = Inventory::where('id',$id)->get();

        $inv = Inventory::find($id);
        $inv->qty = $inventory->get(0)->qty - $request->qty;
        $inv->save();

        $request->session()->flash('alert-success', 'Order Successfully Placed!');
        return redirect()->back();
    }

    public function request(Request $request)
    {
        $input = request()->validate([
     
            'image' => 'mimes:jpeg,jpg,png,bmp,gif,tif,tiff|max:50000|required',
            'name' => 'required|string|max:255',
            'price' => 'required|',
            'description' => 'required|',
            'qty' => 'required|',
            'category' => 'required|',
        ], [
    
        ]);
    
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNametoStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images',$fileNametoStore);
            
        }
  
        
        $requests = new Request_Inventory();
        $requests->repair_id = Auth::user()->id;
        $requests->category = $request->category;
        $requests->name = $request->name;
        $requests->price = $request->price;
        $requests->description = $request->description;
        $requests->qty = $request->qty;
        $requests->image = $fileNametoStore;
        $requests->status = 'pending';
        $requests->save();
        $request->session()->flash('alert-success', 'Request Successfully Placed!');
        return redirect()->back();
    }

    public function view_order()
    {
        $orders = Order::with('inventory','repairs')->where('repair_id',auth::user()->id)->orderBy('created_at','asc')->paginate(10);
        return view('repair.order',['orders'=>$orders]);
    }

    public function view_request()
    {
        $request_inventory = Request_Inventory::with('repairs')->where('repair_id',auth::user()->id)->orderBy('created_at','asc')->paginate(10);
        return view('repair.request',['request_inventory'=>$request_inventory]);
    }

    public function account()
    {
        $repairs = Repair::where('id','=',Auth::user()->id)->get();
        return view('repair.account',['repairs'=>$repairs]);
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
        $repairs = Repair::where('id',$id)->get();
     
        if (Hash::check($request->old_password, $repairs->get(0)->password)) {
            $repair = Repair::find($id);
            $repair->name = $request->name;
            $repair->email = $request->email;
            $repair->contact = $request->contact;
            $repair->address = $request->address;
            $repair->password = Hash::make($request['password']);
            $repair->save();
            $request->session()->flash('alert-success', 'Account successfully updated!');
            return redirect()->back();
        }
        else{
            $request->session()->flash('alert-danger', 'Account not updated!');
            return redirect()->back();
        }
     
     
    }

    public function search_repair(Request $request)
    {
        $search = $request->search;
        $ticket_repairs = Ticket_Repair::with('tickets','repairs')->where('ticket_id',$search)->where('repair_id',Auth::user()->id)->orderBy('created_at','asc')->paginate(10);
        return view('repair.repair',['ticket_repairs'=>$ticket_repairs]);
    }

    public function search_order(Request $request)
    {
        $search = $request->search;
        $inventory = Inventory::where('name',$search)->get();
        $orders = Order::with('inventory','repairs')->where('inventory_id',$inventory->get(0)->id)->where('repair_id',auth::user()->id)->orderBy('created_at','asc')->paginate(10);
        return view('repair.order',['orders'=>$orders]);
    }

    public function search_request(Request $request)
    {
        $search = $request->search;
        $request_inventory = Request_Inventory::with('repairs')->where('name',$search)->where('repair_id',auth::user()->id)->orderBy('created_at','asc')->paginate(10);
        return view('repair.request',['request_inventory'=>$request_inventory]);
    }
}