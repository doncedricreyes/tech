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
        <form action = "{{route('techsupport.repair', $i->id)}}" method="post" enctype="multipart/form-data">
     
            {{csrf_field() }}
 @endforeach
            <div class="form-group">     
                <label for="repair"> Repairman:</label>
              
                <select class="form-control" name="repair" id="repair">
                    @foreach($repairs as $i)
                      <option value="{{$i->id}}">{{$i->name}}</option>
                      @endforeach
               </select>
            </div>
       <div class="form-group">      
            <textarea class="form-control" rows="8"  name="message" id="message" required placeholder="Enter your message..."></textarea>
            <input type="submit" id="submit" class="btn btn-primary" value="Submit">
       </div>
   

     
        </form>

</div>
@endsection