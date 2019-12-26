@extends('layouts.techsupport')

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
            <legend class="tbl-title">Active Tickets</legend>
            <div class="tbl-widg">
                <div class="form-group">
                    <form action = "" role="search" method="get"enctype="multipart/form-data">
                      <input type="text" class="form-control" name="search" id="search" placeholder="Search">
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
                        <th>dop</th>
                        <th>Receipt</th>
                        <th>Status</th>
                        <th>Repairs</th>
                     </thead>
        <tbody>
        
            @foreach($tickets as $i)
            <tr>
                <td><h6>{{ ($tickets ->currentpage()-1) * $tickets ->perpage() + $loop->index + 1 }}</h6></td>
               <td><a href="/techsupport/tickets/{{$i->id}}"> <h6>{{$i->id}}</h6></a></td>
               <td><h6>{{$i->customers->get(0)->name}}</h6></td>
               <td><h6>{{$i->customers->get(0)->contact}}</h6></td>
               <td><h6>{{$i->customers->get(0)->email}}</h6></td>
               <td><h6>{{$i->products->get(0)->brands->name}}</h6></td>
               <td><h6>{{$i->products->get(0)->name}}</h6></td>
               <td><h6>{{$i->branches->get(0)->name}}</h6></td>
               <td><h6>{{$i->dop}}</h6></td>
               <td><a href="/storage/images/{{$i->receipt}}" download="{{$i->receipt}}">{{$i->receipt}}</a></td>
            

               <form action="{{route('techsupport.open.ticket_status',$i->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
               <td><h6><select  name="status" id="status" onchange="this.form.submit()">
                <option selected value> Open </option>
              <option value="pending">Pending</option>
              <option value="closed">Closed</option>
            </select></h6></td>
               </form>
               
               @if($i->repair_id == null)
               <td><a href="/techsupport/tickets/repairs/{{$i->id}}" class="btn btn-primary btn">Assign repairman </a></td>
               @endif
               @if($i->repair_id != null)
               <td><a href="/techsupport/tickets/repairs/{{$i->id}}/messages">{{$i->repairs->get(0)->name}} </a></td>
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