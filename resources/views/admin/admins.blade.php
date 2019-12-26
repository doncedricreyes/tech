





            

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
                        <legend class="tbl-title">Admins</legend>
                        <div class="tbl-widg">
                            <div class="form-group">
                              <form action = "{{route('search_admin')}}" role="search" method="get"enctype="multipart/form-data">
                                <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                              </form>
                              </div>
                            <div>
                                @if(Auth::user()->role == 'superadmin')
                                <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn">Add </a>
                              @endif
                            </div>
                         
                        </div>
                       
                        
                        <div class="table-responsive">
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                  <thead>
                                   
                                        
                                      <th>Name</th>
                                      <th>Email</th>
                                      <th>Role</th>
                                      @if(Auth::user()->role == 'superadmin')
                                     <th>Delete</th>
                               
                                  @endif
                                 </thead>
                    <tbody>
                    
                        @foreach($admins as $i)
                        <tr>
                           <td><h4>{{$i->name}}</h4></td>
                           <td><h4>{{$i->email}}</h4></td>
                          <td><h4>{{$i->role}}</h4></td>
                          <form action = "{{route('delete.admin', $i->id)}}" method="post" enctype="multipart/form-data">
        
                              {{csrf_field() }}
                              <input name="_method" type="hidden" value="PUT">
                              <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="far fa-trash-alt"></i></button></p></td>
                              </form>
                           </form>
                        </tr>
            @endforeach
      
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                        {{ $admins->links() }}
                       
                        </div>
    </div>










    <form action = "{{route('create.admin')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field() }}
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
              
            <div class="form-group">
               
              <label>Name:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                  <label>Email:</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="role"> Role:</label>
                    <select class="form-control" name="role" id="role">
                          <option value="admin">Admin</option>
                          <option value="superadmin">Super admin</option>
                   </select>
                    </div>
                <div class="form-group">
                      <label>Password:</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
     
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Submit Information">
        </div>
      </div>
    </div>
  </div>
  </form>  
    </div>




@endsection