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
            <legend class="tbl-title">My Orders</legend>
            <div class="tbl-widg">
                <div class="form-group">
                    <form action = "{{route('order_search')}}" role="search" method="get"enctype="multipart/form-data">
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
                          <th>Date ordered</th>
                 
                     
                  
                     </thead>
        <tbody>
        
            @foreach($orders as $i)
            <tr>
                <td><h6>{{ ($orders ->currentpage()-1) * $orders ->perpage() + $loop->index + 1 }}</h6></td>
                <td>   <img src="/storage/images/{{$i->inventory->get(0)->image}}"></td>  
               <td><h6>{{$i->inventory->get(0)->category->get(0)->name}}</h6></td>
               <td><h6>{{$i->inventory->get(0)->name}}</h6></td>
               <td><h6>{{$i->inventory->get(0)->description}}</h6></td>
               <td><h6>{{$i->inventory->get(0)->price}}</h6></td>
               <td><h6>{{$i->qty}}</h6></td>
               <td><h6>{{$i->created_at}}</h6></td>
        </tr>
@endforeach

       
        </div>
       
        
        </tbody>
            
    </table>
    <div class="text-center">
            {{ $orders->links() }}
           
            </div>
</div>

    </div>
    @endsection