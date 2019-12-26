@extends('layouts.website')

<style>
    #pic{
        position: relative;
        height: 200px;
        width: 300px;
    }
    </style>
@section('content')

<div class="contact-head">
    <h1>Support and Services</h1>
    <img src="/storage/images/contact.jpeg">
    <div class="overlay"></div>
</div>

<div class="contact-cont">
    <div class="header">
        <h1>Submit a ticket</h1>
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

      
        <form action = "{{route('service.send_ticket')}}" method="post"  enctype="multipart/form-data">
            {{csrf_field() }}
    <div class="contact-form">
 
        
        <div class="form-group">
                @foreach($products as $product)
                <input type="hidden" name="product" id="product" value="{{$product->id}}">
                <div class="inner-addon left-addon">
                        <img id="pic" src="/storage/images/{{$product->pic}}">
                        </div>
         @endforeach
         <div class="inner-addon left-addon">
          
            <select class="form-control" name="branch" id="branch">
                <option disabled selected value> -- select branch -- </option>
                @foreach($branches as $branch)
                <option value="{{$branch->id}}">{{$branch->name}}</option>
                @endforeach
           </select>
            </div>

         <div class="inner-addon left-addon">
                <i class="fas fa-comment-dots"></i>      
                <textarea class="form-control" placeholder="Please describe your problem (eg. Unable to boot)"  name="message" id="message" required></textarea>
                </div>
           </div>
       
           <div class="inner-addon">
                <label>Date of purchase </label>
                <input type="date" class="form-control" name="dop" title="date" required/>
                </div>
                <div class="inner-addon left-addon">
                        <label>Please upload a picture of your receipt </label>
                        <input type="file" class="form-control" name="receipt" title="date" required/>
                        </div>


        <div class="btn-submit">
            <input type="submit" class="btn btn-green" value="Submit Ticket">
        </div>
    </div>
</form> 

</div>


@endsection