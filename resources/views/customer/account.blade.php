@extends('layouts.website')

@section('content')
<style>
#link{
    position: relative;
    float: left;
}
    </style>
<div class="contact-head">
    <h1>Support and Services</h1>
    <img src="/storage/images/contact.jpeg">
    <div class="overlay"></div>
</div>

<div class="contact-cont">
    <div class="header">
        <h1>Edit Account</h1>
        <div class="overlay"></div>
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


    <div class="contact-form">
 

        <div class="row tbl-bg">
                        
                        
            <div class="col-md-12">
          
        
           
            
            <div class="table-responsive">
       
                <form action = "{{route('update.customer')}}" method="post" enctype="multipart/form-data">
                                              
                        {{csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
     
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="{{$customers->get(0)->name}}" class="form-control" > 
                </div>   
                  <div class="form-group">
    
                    <label for="email">Email:</label>
                    <input type="email"  name="email" id="email" value="{{$customers->get(0)->email}}" class="form-control" > 
                </div>
                <div class="form-group">
    
                    <label for="contact">Contact:</label>
                    <input type="number"  name="contact" id="contact" value="{{$customers->get(0)->contact}}" class="form-control" > 
                </div>
                <div class="form-group">
    
                    <label for="address">Address:</label>
                    <input type="text"  name="address" id="address" value="{{$customers->get(0)->address}}" class="form-control" > 
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


</div>


@endsection