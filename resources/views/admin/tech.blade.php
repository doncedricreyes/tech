


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
              <legend class="tbl-title">Tech Supports</legend>
              <div class="tbl-widg">
                  <div class="form-group">
                      <form action = "{{route('search_tech')}}" role="search" method="get"enctype="multipart/form-data">
                        <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                      </form>
                    </div>
                  <div>
                  
                      <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn">Add </a>
               
                  </div>
               
              </div>
             
              
              <div class="table-responsive">
                    <table id="mytable" class="table table-bordred table-striped">
                                   
                                   <thead>
                                   
                                        
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Brand</th>
                                       <th>Status</th>
                                       <th>Delete</th>
                                   </thead>
                    <tbody>
                    
                           @foreach($techsupports as $i)
                            <tr>
                               <td><h4>{{$i->name}}</h4></td>
                               <td><h4>{{$i->email}}</h4></td>
                               <td><h4>{{$i->contact}}</h4></td>
                               <td><h4>{{$i->brands->name}}</h4></td>
                               <td><h4>{{$i->status}}</h4></td>
                              <form action = "{{route('delete.tech', $i->id)}}" method="post" enctype="multipart/form-data">
            
                                  {{csrf_field() }}
                                  <input name="_method" type="hidden" value="PUT">
                                  <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')" value="submit" type="submit" data-title="Delete" data-toggle="modal" data-target="#delete" ><i class="far fa-trash-alt"></i></button></p></td>
                                  </form>
                               </form>
                            </tr>
                @endforeach
                 
                    <div class="text-center">
                
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
                  {{ $techsupports->links() }}
                 
                  </div>
    </div>
    </div>
                    </div>

        



                    
    <form action = "{{route('create.tech')}}" method="post"  enctype="multipart/form-data">
      {{csrf_field() }}
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Tech Support</h5>
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
                  <label>Password:</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>

                <div class="form-group">
               
                        <label>Contact:</label>
                        <input type="number" maxlength="11" class="form-control" id="contact" name="contact" placeholder="Enter contact">
                      </div>

                      <div class="form-group">
                        <label for="brand"> Brand:</label>
                        <select class="form-control" name="brand" id="brand">
                            @foreach($brands as $row)
                              <option value={{$row->id}}>{{$row->name}}</option>
                              @endforeach
                       </select>
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








            








            

    
                
  