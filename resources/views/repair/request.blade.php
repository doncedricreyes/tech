@extends('layouts.repair')

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
            <legend class="tbl-title">My Requests</legend>
            <div class="tbl-widg">
                <div class="form-group">
                    <form action = "{{route('request_search')}}" role="search" method="get"enctype="multipart/form-data">
                      <input type="text" class="form-control" name="search" id="search" placeholder="Search by product">
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
               @if($i->status == 'approved')
               <td><span class="btn btn-success">{{$i->status}}</span></td>
               @endif
               @if($i->status == 'pending')
               <td><span class="btn btn-warning">{{$i->status}}</span></td>
               @endif
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