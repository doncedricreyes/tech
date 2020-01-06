@extends('layouts.website')
@section('content')
<div class="container">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item ">
        <img src="/storage/images/laptop.jpg" style="border-radius:10px" height="600px"class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h3 class="h1-class">Laptops</h5>
        </div>
        </div>
        <div class="carousel-item">
        <img src="/storage/images/iphone.jpg" style="border-radius:10px"height="600px"class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h3 class="h1-class">Phones</h5>
        </div>
        </div>
        <div class="carousel-item active">
        <img src="/storage/images/pc.jpg" style="border-radius:10px"height="600px"class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h3 class="h1-class">Computers</h5>
        </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</div>

<!--PRODUCTS -->
<hr>
<div class="container">

    
    <div class="row">
        @foreach($products as $i)
        <div class="card pl-0  col-sm-4 overlay-product">
            <div class=" row no-gutters">
                <div class="col-md-4">
                    <img src="/storage/images/{{$i->pic}}" class="mt-4 card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$i->brands->name}}</h5>
                        <h5 class="card-title">{{$i->name}}</h5>
                        <p class="card-text">P{{$i->description}}</p>
                        <p class="card-text">P{{$i->price}}</p>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
        <div class="text-center">
            {{ $products->links() }}
           
            </div>


@endsection