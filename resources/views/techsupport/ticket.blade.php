@extends('layouts.techsupport')

<style>
#head{
    position: relative;
    margin: 0%;
}
#submit{
    margin: 10;
    position: relative;
    float: right;
}

</style>
@section('content')



<div class="contact-cont" id="head">
    <div class="header">
      
    </div>

   
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

      

     
 
        @foreach($tickets as $i)
        <form action = "{{route('techsupport.message', $i->id)}}" method="post" enctype="multipart/form-data">
        
            {{csrf_field() }}
        <div class="form-group">      
            <h6>from: {{$i->customers->get(0)->name}}</h6> <h6 id="date">{{$i->created_at}}</h6>
                <textarea class="form-control" rows="8"  name="message" id="message" readonly>{{$i->message}}</textarea>
           </div>
       @endforeach
  
       <br><br>
       @foreach($ticket_messages as $i)
       @if($i->sender_techsupport_id == null)
           <h6>From: {{$i->tickets->get(0)->customers->get(0)->name}} </h6> <h6 id="date">{{$i->created_at}}</h6>
       @endif
       @if($i->sender_techsupport_id != null)
       <h6>To: {{$i->tickets->get(0)->customers->get(0)->name}} </h6> <h6 id="date">{{$i->created_at}}</h6>
   @endif
       <div class="form-group">      
            <textarea class="form-control" rows="8" readonly>{{$i->message}}</textarea>
       </div>
       @endforeach
       <br><br>
       <div class="form-group">      
            <textarea class="form-control" rows="8"  name="message" id="message" required placeholder="Enter your message..."></textarea>
            <input type="submit" id="submit" class="btn btn-primary" value="Send Message">
       </div>
   

     
        </form>

</div>
@endsection