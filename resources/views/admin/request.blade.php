@extends('layouts.admin')

@section('content')
<div class="container" id="view">

    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
    
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div>
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
<div class="container">
        <div class="row tbl-bg">
            
            
            <div class="col-md-12">
            <legend class="tbl-title">Requests</legend>
            <div class="tbl-widg">
                <div class="form-group">
                    <form action = "{{route('search_request')}}" role="search" method="get"enctype="multipart/form-data">
                      <input type="text" class="form-control" name="search" id="search" placeholder="Search by repairman">
                    </form>
                  </div>
                <div>
              
                </div>
             
            </div>
           
            
            <div class="table-responsive">
                  <table id="mytable" class="table table-bordred table-striped">
                       
                      <thead>
                       
                            <th>#</th>
                            <th>Image</th>
                          <th>Category</th>
                          <th>Product</th>
                          <th>Description</th>
                          <th>Unit Price</th>
                          <th>Qty</th>
                          <th>Requested by</th>
                          <th>Date Requested</th>
                          <th>Status</th>
                 
                     
                  
                     </thead>
        <tbody>
        
            @foreach($request_inventory as $i)
            <tr>
                <td><h6>{{ ($request_inventory ->currentpage()-1) * $request_inventory ->perpage() + $loop->index + 1 }}</h6></td>
                <td>   <img src="/storage/images/{{$i->image}}"></td>  
               <td><h6>{{$i->category}}</h6></td>
               <td><h6>{{$i->name}}</h6></td>
               <td><h6>{{$i->description}}</h6></td>
               <td><h6>{{$i->price}}</h6></td>
               <td><h6>{{$i->qty}}</h6></td>
               <td><h6>{{$i->repairs->get(0)->name}}</h6></td>
               <td><h6>{{$i->created_at}}</h6></td>
               <form action="{{route('request_status',$i->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
               <td><h6><select  name="status" id="status" onchange="this.form.submit()">
                @if($i->status == 'pending')
                <option selected value value="pending"> Pending </option>
                @endif
                @if($i->status == 'approved')
              <option selected value value="approved">Approved</option>
              @endif
              @if($i->status == 'rejected')
              <option selected value="" value="rejected">Rejected</option>
              @endif

            <option value="pending"> Pending </option>
            <option value="approved">Approved</option>        
            <option value="rejected">Rejected</option>
            
            </select></h6></td>
               </form>
        
               
        </tr>
@endforeach

       
        </div>
       
        
        </tbody>
            
    </table>
    <div class="text-center">
            {{ $request_inventory->links() }}
           
            </div>
</div>

    </div>
    @endsection