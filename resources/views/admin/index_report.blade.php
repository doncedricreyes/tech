@extends('layouts.admin')

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
            <legend class="tbl-title">Reports</legend>
            <div class="tbl-widg">
                <div class="form-group">
                    <form action = "{{route('search.ticket')}}" role="search" method="get"enctype="multipart/form-data">
                      <input type="text" class="form-control" name="search" id="search" placeholder="Search by report #">
                    </form>
                  </div>
                <div>
              
                </div>
             
            </div>
           
            
            <div class="table-responsive">
                  <table id="mytable" class="table table-bordred table-striped">
                       
                      <thead>
                       
                            <th>#</th>
                          <th>Report #</th>
                          <th>Repairman assigned</th>
                          <th>Customer Name</th>
                          <th>Priority</th>
                          <th>Status</th>
                          <th>Date Created</th>

                  
                     </thead>
        <tbody>
        
            @foreach($reports as $i)
            <tr>
                <td><h6>{{ ($reports ->currentpage()-1) * $reports ->perpage() + $loop->index + 1 }}</h6></td>
               <td><a href="/admin/reports/{{$i->id}}"> <h6>{{$i->id}}</h6></a></td>
               <td> <h6>{{$i->repairs->get(0)->name}}</h6></a></td>
               <td><h6>{{$i->tickets->get(0)->customers->get(0)->name}}</h6></td>
               <td><h6>{{$i->priority}}</h6></td>
               <td><h6>{{$i->tickets->get(0)->status}}</h6></td>
               <td><h6>{{$i->created_at}}</h6></td>


         
         
        </tr>
@endforeach

       
        </div>
       
        
        </tbody>
            
    </table>
    <div class="text-center">
            {{ $reports->links() }}
           
            </div>
</div>

    </div>
    @endsection