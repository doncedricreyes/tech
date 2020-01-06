<?php

namespace App\Http\Controllers;
use App\Ticket;
use App\Techsupport;
use App\Ticket_Message;
use App\Repair;
use App\Ticket_Repair;
use App\Repair_Message;
use App\Customer;
use Hash;
use Auth;
use Image;
use Excel;
use Notification;
use App\Notifications\MessageSubmitted;
use App\Notifications\NewRepair;
use App\Notifications\RepairMessage;
use Illuminate\Http\Request;

class TechsupportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:techsupport');
    }

    public function home()
    {
        return view('techsupport.home');
    }

    public function pending()
    {
        $id = auth::user()->id;
        $tickets = Ticket::where('techsupport_id',$id)->where('status','pending')->orderBy('created_at','asc')->paginate(10);
        return view('techsupport.pending',['tickets'=>$tickets]);
    }

    public function pending_status($id, Request $request)
    {
        
        $tickets = Ticket::find($id);
        $tickets->status = $request->status;
        $tickets->save();
       return redirect()->back();
    }

    public function open()
    {
        $id = auth::user()->id;
        $tickets = Ticket::where('techsupport_id',$id)->where('status','open')->orderBy('created_at','asc')->paginate(10);
        $ticket_repairs = Ticket_Repair::with('tickets','repairs')->get();
        return view('techsupport.open',['tickets'=>$tickets,'ticket_repairs'=>$ticket_repairs]);
    }

    public function open_status($id, Request $request)
    {
        
        $tickets = Ticket::find($id);
        $tickets->status = $request->status;
        $tickets->save();
       return redirect()->back();
    }

    
    public function close()
    {
        $id = auth::user()->id;
        $tickets = Ticket::where('techsupport_id',$id)->where('status','closed')->orderBy('created_at','asc')->paginate(10);
        return view('techsupport.close',['tickets'=>$tickets]);
    }

    public function close_status($id, Request $request)
    {
        
        $tickets = Ticket::find($id);
        $tickets->status = $request->status;
        $tickets->save();
       return redirect()->back();
    }

    public function ticket($id)
    {
       
        $tickets = Ticket::where('id',$id)->get();
        $ticket_messages = Ticket_Message::with('tickets','customers','techsupports')->where('ticket_id',$id)->get();
        return view('techsupport.ticket',['tickets'=>$tickets,'ticket_messages'=>$ticket_messages]);
    }

    public function send_message(Request $request,$id)
    {

        $ticket = Ticket::where('id',$id)->get();
        $customers = Customer::where('id',$ticket->get(0)->customer_id)->get();
        $ticket_messages = new Ticket_Message();
        $ticket_messages->ticket_id = $id;
        $ticket_messages->sender_techsupport_id = Auth::user()->id;
        $ticket_messages->message = $request->message;
        $ticket_messages->recipient_customer_id = $ticket->get(0)->customer_id;
        $ticket_messages->save();
        foreach($customers as $customer){
            Notification::route('mail',$customer->email)->notify(new MessageSubmitted($messages));
            }
        $request->session()->flash('alert-success', 'Message Successfully Sent!');
        return redirect()->back();
    }

    public function repair($id)
    {
        $tickets = Ticket::with('techsupports','customers','products','branches')->where('id',$id)->get();
        $repairs = Repair::with('branches')->where('branch_id',$tickets->get(0)->branch_id)->get();
        return view('techsupport.repair',['tickets'=>$tickets,'repairs'=>$repairs]);
    }


    public function send_repair($id,Request $request)
    {
        $tickets = Ticket::find($id);
        $tickets->repair_id = $request->repair;
        $tickets->save();

        $ticket_repair = new Ticket_Repair();
        $ticket_repair->ticket_id = $id;
        $ticket_repair->repair_id = $request->repair;
        $ticket_repair->message = $request->message;
        $ticket_repair->save();

        $repairs = Repair::where('id',$request->repair)->get();
        foreach($repairs as $repair){
            Notification::route('mail',$repair->email)->notify(new NewRepair($messages));
            }
        $request->session()->flash('alert-success', 'Repairman Successfully Assigned!');
        return redirect()->route('techsupport.open');
    }

    public function repair_message($id)
    {
        $ticket_repairs = Ticket_Repair::with('tickets','repairs')->where('ticket_id',$id)->get();
        $repair_messages = Repair_Message::with('repairs','techsupports','tickets')->where('ticket_id',$id)->get();
        return view('techsupport.repair_message',['ticket_repairs'=>$ticket_repairs,'repair_messages'=>$repair_messages]);
    }

    public function send_repair_message(Request $request,$id)
    {

        $ticket = Ticket::where('id',$id)->get();

        $repair_messages = new Repair_Message();
        $repair_messages->ticket_id = $id;
        $repair_messages->sender_techsupport_id = Auth::user()->id;
        $repair_messages->message = $request->message;
        $repair_messages->recipient_repair_id = $ticket->get(0)->repair_id;
        $repair_messages->save();
        
        $repairs = Repair::where('id',$ticket->get(0)->repair_id)->get();
        foreach($repairs as $repair){
            Notification::route('mail',$repair->email)->notify(new RepairMessage($messages));
            }
        $request->session()->flash('alert-success', 'Message Successfully Sent!');
        return redirect()->back();
    }

    
    public function search_pending(Request $request)
    {
        $search = $request->search;
        
        $id = auth::user()->id;
        $tickets = Ticket::where('id',$search)->where('techsupport_id',$id)->where('status','pending')->orderBy('created_at','asc')->paginate(10);
        if($tickets->isEmpty()){
            $request->session()->flash('alert-danger', 'Ticket not found!');
            return view('techsupport.pending',['tickets'=>$tickets]);
    
        }
        else{
            $request->session()->flash('alert-success', 'Ticket found!');
            return view('techsupport.pending',['tickets'=>$tickets]);
        }
      
    }

    public function search_open(Request $request)
    {
        $search = $request->search;
        
        $id = auth::user()->id;
        $tickets = Ticket::where('id',$search)->where('techsupport_id',$id)->where('status','open')->orderBy('created_at','asc')->paginate(10);
        $ticket_repairs = Ticket_Repair::with('tickets','repairs')->get();
       
        if($tickets->isEmpty()){
            $request->session()->flash('alert-danger', 'Ticket not found!');
            return view('techsupport.open',['tickets'=>$tickets,'ticket_repairs'=>$ticket_repairs]);
    
        }
        else{
            $request->session()->flash('alert-success', 'Ticket found!');
            return view('techsupport.open',['tickets'=>$tickets,'ticket_repairs'=>$ticket_repairs]);
        }
       
    }

    public function search_close(Request $request)
    {
        $search = $request->search;
        
        $id = auth::user()->id;
        $tickets = Ticket::where('id',$search)->where('techsupport_id',$id)->where('status','closed')->orderBy('created_at','asc')->paginate(10);
        if($tickets->isEmpty()){
            $request->session()->flash('alert-danger', 'Ticket not found!');
            return view('techsupport.close',['tickets'=>$tickets]);
    
        }
        else{
            $request->session()->flash('alert-success', 'Ticket found!');
            return view('techsupport.close',['tickets'=>$tickets]);
        }
        
    }

    public function account()
    {
        $techsupports = Techsupport::where('id','=',Auth::user()->id)->get();
        return view('techsupport.account',['techsupports'=>$techsupports]);
    }

    public function account_update(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ], [
  

        ]);
       
        $id = Auth::user()->id;
        $techsupports = Techsupport::where('id',$id)->get();
     
        if (Hash::check($request->old_password, $techsupports->get(0)->password)) {
            $techsupport = Techsupport::find($id);
            $techsupport->name = $request->name;
            $techsupport->email = $request->email;
            $techsupport->password = Hash::make($request['password']);
            $techsupport->save();
            $request->session()->flash('alert-success', 'Account successfully updated!');
            return redirect()->back();
        }
        else{
            $request->session()->flash('alert-danger', 'Account not updated!');
            return redirect()->back();
        }
     
     
    }
}