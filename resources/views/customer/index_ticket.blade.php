@extends('layouts.website')

@section('content')

<div class="contact-head">
    <h1>Support and Services</h1>
    <img src="/storage/images/contact.jpeg">
    <div class="overlay"></div>
</div>

<div class="contact-cont">
    <div class="header">
        <h1>My tickets</h1>
        <div class="overlay"></div>
    </div>

    <p>Feel free to discuss it with us! 
        For inquiries about employment, subcontracting for us, or information about our current project,
         fill up the form below, so we can connect you to the best person to help you.</p>

   
        <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">{{ Session::get('alert-' . $msg) }}<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>
            @endif
        @endforeach
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
           Something went wrong, please try again. 
        </div>
        @endif


    <div class="contact-form">
 

        <div class="row tbl-bg">
                        
                        
            <div class="col-md-12">
          
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
                       
                            
                          <th>Ticket #</th>
                          <th>Product</th>
                          <th>Issue</th>
                          <th>Date submitted</th>
                          <th>Techsupport assigned</th>
                          <th>Status</th>
                     </thead>
        <tbody>
        
           
            @foreach($tickets as $i)
            <tr>
                <td><a href="/customer/service/tickets/{{$i->id}}">{{$i->id}}</a></td>
                <td>{{$i->products->get(0)->name}}</td>
                <td>{{$i->message}}</td>
                <td>{{$i->created_at}}</td>
                <td>{{$i->techsupports->get(0)->name}}</td>
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
    </div>


</div>


@endsection