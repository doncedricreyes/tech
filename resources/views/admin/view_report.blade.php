@extends('layouts.admin')

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
#report{
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

      

     
 
        <form>
        
            {{csrf_field() }}

     
  
     

       <div class="form-group">     
        <label>Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$reports->get(0)->tickets->get(0)->customers->get(0)->name}}" readonly>  
   </div> 
       <div class="form-group">    
           <label>Email:</label> 
        <input type="email" class="form-control" id="email" name="email" value="{{$reports->get(0)->tickets->get(0)->customers->get(0)->email}}" readonly>  
   </div> 
   <div class="form-group">    
    <label>Contact:</label> 
 <input type="number" class="form-control" id="contact" name="contact" value="{{$reports->get(0)->tickets->get(0)->customers->get(0)->contact}}" readonly>  
</div> 
<div class="form-group">    
    <label>Branch:</label> 
 <input type="text" class="form-control" id="branch" name="branch" value="{{$reports->get(0)->tickets->get(0)->branches->get(0)->name}}" readonly>  
</div>
<div class="form-group">    
    <label>Brand:</label> 
 <input type="text" class="form-control" id="brand" name="brand" value="{{$reports->get(0)->tickets->get(0)->products->get(0)->brands->name}}" readonly>  
</div> 
<div class="form-group">    
    <label>Product:</label> 
 <input type="text" class="form-control" id="product" name="product" value="{{$reports->get(0)->tickets->get(0)->products->get(0)->name}}" readonly>  
</div> 
<div class="form-group">    
    <label>Priority:</label> 
 <input type="text" class="form-control" id="product" name="product" value="{{$reports->get(0)->priority}}" readonly>  
</div> 
<div class="form-group">    
    <label>Cost:</label> 
 <input type="text" class="form-control" id="cost" name="cost" value="{{$reports->get(0)->cost}}" readonly>  
</div> 
<div class="form-group">    
    <label>Repairman assigned:</label> 
 <input type="text" class="form-control" id="product" name="product" value="{{$reports->get(0)->repairs->get(0)->name}}" readonly>  
</div> 
   <div class="form-group"> 
       <label>Issue:</label>
            <textarea class="form-control" rows="8"  name="issue" id="issue" readonly>{{$reports->get(0)->issue}}</textarea>
        </div>
        <div class="form-group">
            <label>Solution:</label>
            <textarea class="form-control" rows="8"  name="solution" id="solution" readonly>{{$reports->get(0)->solution}}</textarea>
        </div>
        </form>


   
   
      
    
   

</div>
@endsection