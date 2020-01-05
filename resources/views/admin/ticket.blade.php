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
            <legend class="tbl-title">Tickets</legend>
            <div class="tbl-widg">
                <div class="form-group">
                    <form action = "{{route('admin.search_ticket')}}" role="search" method="get"enctype="multipart/form-data">
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
                          <th>Customer Name</th>
                          <th>Contact #</th>
                          <th>Email</th>
                          <th>Brand</th>
                          <th>Product</th>
                          <th>Branch</th>
                        <th>Techsupport assigned</th>
                        <th>Repairman assigned</th>
                        <th>Status</th>
                     </thead>
        <tbody>
        
            @foreach($tickets as $i)
            <tr>
                <td><h6>{{ ($tickets ->currentpage()-1) * $tickets ->perpage() + $loop->index + 1 }}</h6></td>
               <td><a href="/admin/tickets/{{$i->id}}"> <h6>{{$i->id}}</h6></a></td>
               <td><h6>{{$i->customers->get(0)->name}}</h6></td>
               <td><h6>{{$i->customers->get(0)->contact}}</h6></td>
               <td><h6>{{$i->customers->get(0)->email}}</h6></td>
               <td><h6>{{$i->products->get(0)->brands->name}}</h6></td>
               <td><h6>{{$i->products->get(0)->name}}</h6></td>
               <td><h6>{{$i->branches->get(0)->name}}</h6></td>
               <td><h6>{{$i->techsupports->get(0)->name}}</h6></td>
               <td><h6>{{$i->repairs->get(0)->name}}</h6></td>
               @if($i->status == 'open')
               <td><span class="btn btn-success">{{$i->status}}</span></td>
               @endif
               @if($i->status == 'pending')
               <td><span class="btn btn-warning">{{$i->status}}</span></td>
               @endif
               @if($i->status == 'closed')
               <td><span class="btn btn-danger">{{$i->status}}</span></td>
               @endif
        </tr>
@endforeach

       
        </div>
       
        
        </tbody>
            
    </table>
    <div class="text-center">
            {{ $tickets->links() }}
           
            </div>
</div>

    </div>
    @endsection