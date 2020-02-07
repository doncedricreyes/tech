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

      

     
 
        <form action = "{{route('create_report')}}" method="post" enctype="multipart/form-data">
        
            {{csrf_field() }}

     
  
        <input type="hidden" name="ticket" id="ticket" value="{{$tickets->get(0)->id}}">

       <div class="form-group">     
        <label>Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{$tickets->get(0)->customers->get(0)->name}}" readonly>  
   </div> 
       <div class="form-group">    
           <label>Email:</label> 
        <input type="email" class="form-control" id="email" name="email" value="{{$tickets->get(0)->customers->get(0)->email}}" readonly>  
   </div> 
   <div class="form-group">    
    <label>Contact:</label> 
 <input type="number" class="form-control" id="contact" name="contact" value="{{$tickets->get(0)->customers->get(0)->contact}}" readonly>  
</div> 
<div class="form-group">    
    <label>Branch:</label> 
 <input type="text" class="form-control" id="branch" name="branch" value="{{$tickets->get(0)->branches->get(0)->name}}" readonly>  
</div>
<div class="form-group">    
    <label>Brand:</label> 
 <input type="text" class="form-control" id="brand" name="brand" value="{{$tickets->get(0)->products->get(0)->brands->name}}" readonly>  
</div> 
<div class="form-group">    
    <label>Product:</label> 
 <input type="text" class="form-control" id="product" name="product" value="{{$tickets->get(0)->products->get(0)->name}}" readonly>  
</div> 
<div class="form-group">
    <label for="priority"> Priority:</label>
    <select class="form-control" name="priority" id="priority">
          <option value="low">Low</option>
          <option value="medium">Medium</option>
          <option value="hight">High</option>
   </select>
</div>
<div class="form-group">
    <label for="repair">Assign Repairman:</label>
    <select class="form-control" name="repair" id="repair">
          <option value="">None</option>
          @foreach($repairs as $i)
          <option value="{{$i->id}}">{{$i->name}}</option>
          @endforeach
   </select>
</div>
<div class="form-group">    
    <label>Cost:</label> 
 <input type="number" class="form-control" id="cost" name="cost">  
</div> 
   <div class="form-group"> 
            <textarea class="form-control" rows="8"  name="issue" id="issue" required placeholder="Issue"></textarea>
        </div>
        <div class="form-group">
            <textarea class="form-control" rows="8"  name="solution" id="solution" required placeholder="Solution"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" id="submit" class="btn btn-primary" value="Submit">
        </div>
        </form>


   
   
      
    
   

</div>
@endsection