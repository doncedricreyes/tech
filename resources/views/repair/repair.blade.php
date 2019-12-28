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
            <legend class="tbl-title">My Repairs</legend>
            <div class="tbl-widg">
                <div class="form-group">
                    <form action = "{{route('repair_search')}}" role="search" method="get"enctype="multipart/form-data">
                      <input type="text" class="form-control" name="search" id="search" placeholder="Search by ticket #">
                    </form>
                  </div>
                <div>
              
                </div>
             
            </div>
           
            
            <div class="table-responsive">
                  <table id="mytable" class="table table-bordred table-striped">
                       
                      <thead>
                       
                            <th>#</th>
                          <th>ticket #</th>
                          <th>Brand</th>
                          <th>Product</th>
                 
                     
                  
                     </thead>
        <tbody>
        
            @foreach($ticket_repairs as $i)
            <tr>
                <td><h6>{{ ($ticket_repairs ->currentpage()-1) * $ticket_repairs ->perpage() + $loop->index + 1 }}</h6></td>
               <td><a href="/repair/repairs/{{$i->ticket_id}}"> <h6>{{$i->ticket_id}}</h6></a></td>
               <td><h6>{{$i->tickets->get(0)->products->get(0)->brands->name}}</h6></td>
               <td><h6>{{$i->tickets->get(0)->products->get(0)->name}}</h6></td>
        
             
        </tr>
@endforeach

       
        </div>
       
        
        </tbody>
            
    </table>
    <div class="text-center">
            {{ $ticket_repairs->links() }}
           
            </div>
</div>

    </div>
    @endsection