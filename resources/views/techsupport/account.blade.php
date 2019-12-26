


   


@extends('layouts.techsupport')

@section('content')
<style>
.container{
    background: white;
    box-shadow: 1px 3px 5px -2px #000000b5;
    padding:20px
}
legend{
    margin-bottom: 30px;
    font-size: 30px;
}
</style>
<div class="container" id="view">
        <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
            
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
                @endforeach
              </div> <!-- end .flash-message -->
              
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
     
     
     
            <legend>Edit Account</legend>
            <form action = "{{route('update.techsupport')}}" method="post" enctype="multipart/form-data">
                                          
                    {{csrf_field() }}
                    <input name="_method" type="hidden" value="PUT">
 
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{$techsupports->get(0)->name}}" class="form-control" > 
            </div> 
            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="number" name="contact" id="contact" value="{{$techsupports->get(0)->contact}}" class="form-control" > 
            </div>   
              <div class="form-group">

                <label for="email">Email:</label>
                <input type="email"  name="email" id="email" value="{{$techsupports->get(0)->email}}" class="form-control" > 
            </div>
            <div class="form-group">
                <label for="old_password">Old Password:</label>
                <input type="password" name="old_password" id="old_password" class="form-control" > 
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" > 
            </div> 
            <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" > 
                </div> 
                <div style="text-align:right">
                    <button type="submit" id="submit" class="btn btn-green">Update</button>
                </div>
           
        
        </form>                           

    </div>
@endsection

            

    
                
  
        
        

   

            

    
                
  