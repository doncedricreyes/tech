





            

@extends('layouts.admin')

@section('content')
<style>
.modal-content .modal-body .form-group{
   margin:0 !important;
}
</style>
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
                        <legend class="tbl-title">Customer</legend>
                        <div class="tbl-widg">
                            <div class="form-group">
      
                              </div>
                            <div>
                   
                            </div>
                         
                        </div>
                       
                        
                        <div class="table-responsive">
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                  <thead>
                                   
                                        
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Contact</th>
                                      <th>Address</th>
                               
                                  
                                 </thead>
                    <tbody>
                    
                        @foreach($customers as $i)
                        <tr>
                           <td><h4>{{$i->name}}</h4></td>
                           <td><h4>{{$i->email}}</h4></td>
                          <td><h4>{{$i->contact}}</h4></td>
                          <td><h4>{{$i->address}}</h4></td>
                        </tr>
            @endforeach
      
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                        {{ $customers->links() }}
                       
                        </div>
    </div>





 
    </div>




@endsection