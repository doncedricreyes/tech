@extends('layouts.website')

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

<form action = "{{route('service.brand')}}" method="post"  enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="contact-form">
 
     



        <div class="form-group">
            <select name="brand" id="brand" class="form-control input-lg dynamic" data-dependent="state">
             <option value="">Select Brand</option>
             @foreach($brands as $brand)
             <option value="{{ $brand->id}}">{{ $brand->name }}</option>
             @endforeach
            </select>
           </div>


   
        <div class="btn-submit">
            <input type="submit" class="btn btn-green" value="Next">
        </div>
    </div>
</form> 

</div>


@endsection