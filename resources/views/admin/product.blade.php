

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
                        <legend class="tbl-title">Products</legend>
                        <div class="tbl-widg">
                            <div class="form-group">
                                <form action = "{{route('search_product')}}" role="search" method="get"enctype="multipart/form-data">
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
                                   
                                        
                                            <th>Product Name</th>
                                            <th>Brand Name</th>
                                            <th>Picture</th>
                                            <th>Price</th>
                                            <th>Description</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                  
                                       </thead>
                    <tbody>
                    
                            @foreach($products as $i)
                            <tr>
                               <td><h4>{{$i->name}}</h4></td>
                               <td><h4>{{$i->brands->name}}</h4></td>
                               <td>   <img src="/storage/images/{{$i->pic}}"></td>                               
                               <td><h4>{{$i->price}}</h4></td>
                               <td><h4>{{$i->description}}</h4></td>
                               <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-id="{!! $i->id !!}" data-target="#edit-{{$i->id}}" ><i class="far fa-edit"></i></button></p></td>
                              <form action = "{{route('delete.product', $i->id)}}" method="post" enctype="multipart/form-data">
            
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
                        {{ $products->links() }}
                       
                        </div>
    </div>









                    
    <form action = "{{route('create.product')}}" method="post"  enctype="multipart/form-data">
        {{csrf_field() }}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                
              <div class="form-group">
                <label>Product Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
              </div>
              <div class="form-group">
                  <label for="brand"> Brand:</label>
                  <select class="form-control" name="brand" id="brand">
                      @foreach($brands as $row)
                        <option value={{$row->id}}>{{$row->name}}</option>
                        @endforeach
                 </select>
                  </div>
                  <div class="form-group">
                          <label>Price:</label>
                          <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
                        </div>
                        <div class="form-group">
                              <label>Description:</label>
                              <textarea rows="4" name="desc" id="desc" class="form-control"> </textarea>
                            </div>
                            <div class="form-group">
                                  <label>Picture:</label>
                                  <input type="file" class="form-control" id="pic" name="pic" placeholder="Upload picture">
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
  
    @foreach($products as $i)
    <form action = "{{route('edit.product', $i->id)}}" method="post" enctype="multipart/form-data">
        
        {{csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        <div class="modal fade" id="edit-{{$i->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
          
          <div class="form-group">
            <label>Product Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder={{$i->name}}>
          </div>
          <div class="form-group">
              <label for="brand"> Brand:</label>
              <select class="form-control" name="brand" id="brand">
                  @foreach($brands as $row)
                    <option value={{$row->id}}>{{$row->name}}</option>
                    @endforeach
             </select>
              </div>
              <div class="form-group">
                      <label>Price:</label>
                      <input type="number" class="form-control" id="price" name="price" placeholder={{$i->price}}>
                    </div>
                    <div class="form-group">
                          <label>Description:</label>
                          <textarea rows="4" name="desc" id="desc" class="form-control">{{$i->description}} </textarea>
                        </div>
                        <div class="form-group">
                              <label>Picture:</label>
                              <input type="file" class="form-control" id="pic" name="pic" placeholder="Upload picture">
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
    @endforeach     
    </div>




@endsection


            

    
                
  