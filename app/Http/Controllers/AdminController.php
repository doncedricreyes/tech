<?php

namespace App\Http\Controllers;
use Hash;
use App\Admin;
use App\Repair;
use App\Techsupport;
use App\Brand;
use App\Branch;
use App\Product;
use App\Category;
use App\Inventory;
use App\Order;
use App\Request_Inventory;
use App\Ticket;
use App\Ticket_Message;
use Auth;
use Image;
use Excel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
    
        $admins = Admin::where('status','active')->orderBy('name')->paginate(10);
        return view('admin.admins',['admins'=>$admins]);
     
    }
  
    public function admin()
    {
        $admins = Admin::where('status','active')->orderBy('name')->paginate(10);
        return view('admin.admins',['admins'=>$admins]);
    }

    public function create_admin(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u|unique:admins|',
           'email' => 'required|string|email|max:255|unique:admins',
           'password' => 'required|string|min:6|',
          

       ], [
           'name.regex'=>'Name contains invalid character!',
       ]);

   
       $admin = new Admin();
       $admin->role = $request->role;
       $admin->name = $request->name;
       $admin->email=$request->email;
       $admin->password = Hash::make($request->password);
       $admin->status = "active";
       $admin->save();
       $request->session()->flash('alert-success', 'Account Successfully Created!');
       return redirect()->back();
    }

    public function delete_admin($id,Request $request)
    {
        $admin = Admin::find($id);
        $admin->status = 'inactive';
        $admin->save();
        $request->session()->flash('alert-success', 'Admin successfully removed!');
        return redirect()->back();
    }

    public function repair()
    {
       $branches = Branch::get();
        $repairs = Repair::with('branches')->where('status','active')->orderBy('name')->paginate(10);
        return view('admin.repair',['repairs'=>$repairs,'branches'=>$branches]);
    }
    
    public function create_repair(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u|unique:repairs|',
            'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|unique:repairs',
            'address' => 'required|',
           'email' => 'required|string|email|max:255|unique:repairs|unique:admins',
           'password' => 'required|string|min:6|',
          

       ], [
           'name.regex'=>'Name contains invalid character!',
           'contact.regex'=>'Invalid contact!'
       ]);

   
       $repair = new Repair();
       $repair->role = 'repairman';
       $repair->branch_id = $request->branch;
       $repair->name = $request->name;
       $repair->email=$request->email;
       $repair->contact=$request->contact;
       $repair->address=$request->address;
       $repair->password = Hash::make($request->password);
       $repair->status = "active";
       $repair->save();
       $request->session()->flash('alert-success', 'Account Successfully Created!');
       return redirect()->back();
    }

    public function delete_repair($id,Request $request)
    {
        $repair = Repair::find($id);
        $repair->status = 'inactive';
        $repair->save();
        $request->session()->flash('alert-success', 'Account successfully removed!');
        return redirect()->back();
    }

    public function tech()
    {
        $techsupports = Techsupport::where('status','active')->orderBy('name')->paginate(10);
        return view('admin.tech',['techsupports'=>$techsupports]);
    }
    
    public function create_tech(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z,. ]+$/u|unique:techsupports|',
            'contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|unique:techsupports|',
           'email' => 'required|string|email|max:255|unique:techsupports|unique:techsupports',
           'password' => 'required|string|min:6|',
          

       ], [
           'name.regex'=>'Name contains invalid character!',
           'contact.regex'=>'Invalid contact!'
       ]);

   
       $tech = new Techsupport();
       $tech->role = "techsupport";
       $tech->name = $request->name;
       $tech->email=$request->email;
       $tech->contact=$request->contact;
       $tech->password = Hash::make($request->password);
       $tech->status = "active";
       $tech->save();
       $request->session()->flash('alert-success', 'Account Successfully Created!');
       return redirect()->back();
    }

    public function delete_tech($id,Request $request)
    {
        $tech = Techsupport::find($id);
        $tech->status = 'inactive';
        $tech->save();
        $request->session()->flash('alert-success', 'Account successfully removed!');
        return redirect()->back();
    }


    public function show_brand()
    {
        $brands = Brand::where('status','=','active')->orderBy('name')->paginate(10);
        return view('admin.brand',['brands'=>$brands]);
    }

    public function create_brand(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|unique:brands',
          

       ], [

       ]);

   
       $brand = new Brand();
       $brand->name = $request->name;
       $brand->status = "active";
       $brand->save();
       $request->session()->flash('alert-success', 'Brand Successfully Created!');
       return redirect()->back();
    }

    public function delete_brand($id,Request $request)
    {
        $brand = Brand::find($id);
        $brand->status = 'inactive';
        $brand->save();
        $request->session()->flash('alert-success', 'Brand successfully removed!');
        return redirect()->back();
    }


    public function edit_brand($id,Request $request)
    {
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->save();
        $request->session()->flash('alert-success', 'Brand successfully updated!');
        return redirect()->back();
    }


    public function show_branch()
    {
        $branches = Branch::where('status','=','active')->orderBy('name')->paginate(10);
        return view('admin.branch',['branches'=>$branches]);
    }

    public function create_branch(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|unique:branches',
          

       ], [

       ]);

   
       $branch = new Branch();
       $branch->name = $request->name;
       $branch->status = "active";
       $branch->address = $request->address;
       $branch->save();
       $request->session()->flash('alert-success', 'Branch Successfully Added!');
       return redirect()->back();
    }

    public function delete_branch($id,Request $request)
    {
        $branch = Branch::find($id);
        $branch->status = 'inactive';
        $branch->save();
        $request->session()->flash('alert-success', 'Branch successfully removed!');
        return redirect()->back();
    }


    public function edit_branch($id,Request $request)
    {
        $branch = Branch::find($id);
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->save();
        $request->session()->flash('alert-success', 'Branch successfully updated!');
        return redirect()->back();
    }



    public function show_product()
    {
        $products = Product::with('brands')->where('status','=','available')->orderBy('name')->paginate(10);
        $brands = Brand::where('status','=','active')->orderBy('name')->paginate(10);
        return view('admin.product',['brands'=>$brands,'products'=>$products]);
    }

    public function create_product(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'desc' => 'required|string|',
            'pic' => 'mimes:jpeg,jpg,png,bmp,gif,tif,tiff|max:50000|',

       ], [

       ]);

       if ($request->hasFile('pic')) {
        $filenameWithExt = $request->file('pic')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('pic')->getClientOriginalExtension();
        $fileNametoStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('pic')->storeAs('public/images',$fileNametoStore);
        
    }
   
       $product = new Product();
       $product->name = $request->name;
       $product->brand_id = $request->brand;
       $product->price = $request->price;
       $product->description = $request->desc;
       $product->status = "available";
       $product->pic = $fileNametoStore;
       $product->save();
       $request->session()->flash('alert-success', 'Product Successfully Added!');
       return redirect()->back();
    }

    public function delete_product($id,Request $request)
    {
        $products = Product::find($id);
        $products->status = 'unavailable';
        $products->save();
        $request->session()->flash('alert-success', 'Product successfully removed!');
        return redirect()->back();
    }


    public function edit_product($id,Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|string|max:255',
            'desc' => 'required|string|',
            'pic' => 'mimes:jpeg,jpg,png,bmp,gif,tif,tiff|max:50000|',

       ], [

       ]);

       if ($request->hasFile('pic')) {
        $filenameWithExt = $request->file('pic')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('pic')->getClientOriginalExtension();
        $fileNametoStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('pic')->storeAs('public/images',$fileNametoStore);
        
    }

        $product = Product::find($id);
       $product->name = $request->name;
       $product->brand_id = $request->brand;
       $product->price = $request->price;
       $product->description = $request->desc;
       $product->status = "available";
       $product->pic = $fileNametoStore;
       $product->save();
       $request->session()->flash('alert-success', 'Product Successfully Updated!');
       return redirect()->back();
    }


    public function inventory(Request $request)
    {
        $cat = $request->category;
        $inventory = Inventory::with('category')->where('category_id',$cat)->get();
        $category = Category::get();
  
        return view('admin.inventory',['category'=>$category,'inventory'=>$inventory]);
    }

    public function category(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|unique:category|',

          

       ], [
     
       ]);

        $category = new Category();
        $category->name = $request->name;
        $category->save();
        $request->session()->flash('alert-success', 'Category Successfully Created!');
        return redirect()->back();
    }



    public function inventory_product(Request $request)
    {
        $input = request()->validate([
            'name' => 'required|string|max:255|unique:category|',
            'description' => 'required|',
            'price' => 'required|',
            'qty' => 'required|',
            'image' => 'mimes:jpeg,jpg,png,bmp,gif,tif,tiff|max:50000|required',
       ], [
     
       ]);

       if ($request->hasFile('image')) {
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileNametoStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('image')->storeAs('public/images',$fileNametoStore);
        
    }

        $inventory = new Inventory();
        $inventory->category_id = $request->category;
        $inventory->name = $request->name;
        $inventory->description = $request->description;
        $inventory->price = $request->price;
        $inventory->qty = $request->qty;
        $inventory->image = $fileNametoStore;
        $inventory->save();
        $request->session()->flash('alert-success', 'Product Successfully Created!');
        return redirect()->back();
    }


    public function order()
    {
        $orders = Order::with('inventory','repairs')->orderBy('created_at','asc')->paginate(10);
        return view('admin.order',['orders'=>$orders]);
    }


    public function request()
    {
        $request_inventory = Request_Inventory::with('repairs')->orderBy('created_at','asc')->paginate(10);
        return view('admin.request',['request_inventory'=>$request_inventory]);
    }


    public function search_admin(Request $request)
    {
        $search = $request->search;
        $admins = Admin::where('name','=',$search)
        ->where('status','=','active')
        ->orderBy('name')->paginate(10);
       
        if($admins->isEmpty()){
            $request->session()->flash('alert-danger', 'User not found!');
            return view('admin.admins',['admins'=>$admins]);
 
        }
        else{
            $request->session()->flash('alert-success', 'User found!');
            return view('admin.admins',['admins'=>$admins]);
        }
      
    
    }

    public function search_tech(Request $request)
    {
        $search = $request->search;
        $techsupports = Techsupport::where('name','=',$search)
        ->where('status','=','active')
        ->orderBy('name')->paginate(10);

        if($techsupports->isEmpty()){
            $request->session()->flash('alert-danger', 'User not found!');
            return view('admin.tech',['techsupports'=>$techsupports]);
 
        }
        else{
            $request->session()->flash('alert-success', 'User found!');
            return view('admin.tech',['techsupports'=>$techsupports]);
        }
     
    }

    public function search_repair(Request $request)
    {
        $search = $request->search;
       $repairs = Repair::with('branches')->where('name','=',$search)->where('status','active')->orderBy('name')->paginate(10);


       if($repairs->isEmpty()){
        $request->session()->flash('alert-danger', 'User not found!');
        return view('admin.repair',['repairs'=>$repairs]);

    }
    else{
        $request->session()->flash('alert-success', 'User found!');
        return view('admin.repair',['repairs'=>$repairs]);
    }
        
    }

    public function search_brand(Request $request)
    {
        $search = $request->search;
       $brands = Brand::where('name','=',$search)->where('status','=','active')->orderBy('name')->paginate(10);
       
       if($brands->isEmpty()){
        $request->session()->flash('alert-danger', 'Brand name not found!');
        return view('admin.brand',['brands'=>$brands]);

    }
    else{
        $request->session()->flash('alert-success', 'Brand name found!');
        return view('admin.brand',['brands'=>$brands]);
    }
 
    }
    
    public function search_product(Request $request)
    {
        $search = $request->search;
        $products = Product::with('brands')->where('name',$search)->where('status','=','available')->orderBy('name')->paginate(10);
        $brands = Brand::where('status','=','active')->orderBy('name')->paginate(10);
        if($products->isEmpty()){
            $request->session()->flash('alert-danger', 'Product not found!');
            return view('admin.product',['brands'=>$brands,'products'=>$products]);
    
        }
        else{
            $request->session()->flash('alert-success', 'Product found!');
            return view('admin.product',['brands'=>$brands,'products'=>$products]);
        }
    
    }

    public function search_branch(Request $request)
    {
        $search = $request->search;
        $branches = Branch::where('name',$search)->where('status','=','active')->orderBy('name')->paginate(10);
        if($branches->isEmpty()){
            $request->session()->flash('alert-danger', 'Branch not found!');
            return view('admin.branch',['branches'=>$branches]);
    
        }
        else{
            $request->session()->flash('alert-success', 'Branch found!');
            return view('admin.branch',['branches'=>$branches]);
        }

    }
    public function search_order(Request $request)
    {
        $search = $request->search;
        $repair = Repair::where('name',$search)->get();
        $orders = Order::with('inventory','repairs')->where('repair_id',$repair->get(0)->id)->orderBy('created_at','asc')->paginate(10);
        if($orders->isEmpty()){
            $request->session()->flash('alert-danger', 'Order not found!');
            return view('admin.order',['orders'=>$orders]);
    
        }
        else{
            $request->session()->flash('alert-success', 'Order found!');
            return view('admin.order',['orders'=>$orders]);
        }
    
    }

    public function search_request(Request $request)
    {
        $search = $request->search;
        $repair = Repair::where('name',$search)->get();
        $request_inventory = Request_Inventory::with('repairs')->where('repair_id',$repair->get(0)->id)->orderBy('created_at','asc')->paginate(10);
        if($request_inventory->isEmpty()){
            $request->session()->flash('alert-danger', 'Request not found!');
            return view('admin.request',['request_inventory'=>$request_inventory]);
    
        }
        else{
            $request->session()->flash('alert-success', 'Request found!');
            return view('admin.request',['request_inventory'=>$request_inventory]);
        }
     
    }


    public function account()
    {
        $admin = Admin::where('id','=',Auth::user()->id)->get();
        return view('admin.account',['admin'=>$admin]);
    }

    public function account_update(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ], [
  

        ]);
       
        $id = Auth::user()->id;
        $admins = Admin::where('id',$id)->get();
     
        if (Hash::check($request->old_password, $admins->get(0)->password)) {
            $admin = Admin::find($id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->password = Hash::make($request['password']);
            $admin->save();
            $request->session()->flash('alert-success', 'Account successfully updated!');
            return redirect()->back();
        }
        else{
            $request->session()->flash('alert-danger', 'Account not updated!');
            return redirect()->back();
        }
     
     
    }

    
    public function request_status($id, Request $request)
    {
        
        $requests = Request_Inventory::find($id);
        $requests->status = $request->status;
        $requests->save();
       return redirect()->back();
    }

    public function ticket()
    {
        $tickets = Ticket::paginate(10);
        return view('admin.ticket',['tickets'=>$tickets]);
    }

    public function ticket_message($id)
    {
       
        $tickets = Ticket::where('id',$id)->get();
        $ticket_messages = Ticket_Message::with('tickets','customers','techsupports')->where('ticket_id',$id)->get();
        return view('admin.ticket_message',['tickets'=>$tickets,'ticket_messages'=>$ticket_messages]);
    }

    public function search_ticket(Request $request)
    {
        $search = $request->search;
        
    
        $tickets = Ticket::where('id',$search)->paginate(10);
        if($tickets->isEmpty()){
            $request->session()->flash('alert-danger', 'Ticket not found!');
            return view('admin.ticket',['tickets'=>$tickets]);
    
        }
        else{
            $request->session()->flash('alert-success', 'Ticket found!');
            return view('admin.ticket',['tickets'=>$tickets]);
        }
      
    }

}