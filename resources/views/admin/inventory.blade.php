
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
                        <legend class="tbl-title">Inventory</legend>
                        <div class="tbl-widg">
                            <div class="form-group">
                                <form action="{{route('inventory')}}" method="GET">
                                <select class="form-control" name="category" id="category"  onchange="this.form.submit()">
                                    <option disabled selected value> -- select category -- </option>
                                    @foreach($category as $i)
                                      <option value="{{$i->id}}">{{$i->name}}</option>
                                      @endforeach
                               </select>
                                </form>
                              </div>
                            <div>
                               
                                <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn">Add Product </a>
                                <a href="" data-toggle="modal" data-target="#exampleModal2" class="btn btn-primary btn">Add Category </a>
                            </div>
                         
                        </div>
                       
                        
                        <div class="table-responsive">
                              <table id="mytable" class="table table-bordred table-striped">
                                   
                                  <thead>
                                   
                                        <th>Image</th>
                                      <th>Product Name</th>
                                      <th>Description</th>
                                      <th>Price</th>
                                     <th>Stock</th>
                               
                         
                                 </thead>
                    <tbody>
                    
                            @foreach($inventory as $i)
                        <tr>
                            <td>   <img src="/storage/images/{{$i->image}}"></td>  
                            <td><h4>{{$i->name}}</h4></td>
                            <td><h4>{{$i->description}}</h4></td>
                                                      
                            <td><h4>{{$i->price}}</h4></td>
                            <td><h4>{{$i->qty}}</h4></td>
                        </tr>
@endforeach
      
                   
                    </div>
                   
                    
                    </tbody>
                        
                </table>
                <div class="text-center">
         
                       
                        </div>
    </div>










    <form action = "{{route('create.inventory_product')}}" method="post"  enctype="multipart/form-data">
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
                <label for="category"> Category:</label>
                <select class="form-control" name="category" id="category">
                    @foreach($category as $i)
                      <option value="{{$i->id}}">{{$i->name}}</option>
                      @endforeach
               </select>
                </div>

            <div class="form-group">
              <label>Product Name:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div>
            <br>
            <div class="form-group">
                <textarea class="form-control" placeholder="Description"  name="description" id="description" required></textarea>
                </div>
           
                <div class="form-group">
                      <label>Unit Price:</label>
                      <input type="number" class="form-control" id="price" name="price" placeholder="Enter unit price">
                    </div>
 
                    <div class="form-group">
                        <label>Qty:</label>
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="Enter quantity">
                      </div>

                      <div class="form-group">
                        <label>Image:</label>
                        <input type="file" class="form-control" name="image"  required/>
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


  <form action = "{{route('create.category')}}" method="post"  enctype="multipart/form-data">
    {{csrf_field() }}
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            
          <div class="form-group">
             
            <label>Category Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
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