@extends('layout.master')
@push('css')
<style>
        img.h-100 {
            height: 500px !important;
        }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
<div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <input type="text" value={{$product['id']}} class="d-none" id="idProduct">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light" id="listImg"> 
                        <div class="carousel-item active">
                            <img class="w-100 h-100" style="height: 100%;" src={{asset('storage/'.$product['img'][0]['path'] )}} alt="Image">
                        </div>
                        @forelse ($data as $item)
                       <div class="carousel-item">
                            <img class="w-100 h-100" src={{ asset('storage/'.$item['img'][0]['path'] )}} alt="Image">
                        </div>
                        @empty
                            
                        @endforelse
                        
                        
                        {{-- <div class="carousel-item">
                            <img class="w-100 h-100" src={{ asset("img/product-3.jpg")}} alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src={{ asset("img/product-4.jpg")}} alt="Image">
                        </div> --}}
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$product['name']}}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$product['priceSell']}}</h3>
                    <p class="mb-4">{{$product['description']}}</p>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Colors:</strong>
                        <form>
                            @forelse ($data as $item)
                                <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input color" value={{$item['color_product']['id']}} id="color-{{$item['id']}}" name="color">
                                <label class="custom-control-label" for="color-{{$item['id']}}">{{$item['color_product']['name']}}</label>
                            </div>
                            @empty
                                
                            @endforelse
                            {{-- <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-1" name="color">
                                <label class="custom-control-label" for="color-1">Black</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-2" name="color">
                                <label class="custom-control-label" for="color-2">White</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-3" name="color">
                                <label class="custom-control-label" for="color-3">Red</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-4" name="color">
                                <label class="custom-control-label" for="color-4">Blue</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="color-5" name="color">
                                <label class="custom-control-label" for="color-5">Green</label>
                            </div> --}}
                        </form>
                    </div>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Sizes:</strong>
                        <form id="listSize">
                            <div class="btn-primary" style="padding: 5px"> Vui lòng chọn màu trước</div>
                           
                            {{-- <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-1" name="size">
                                <label class="custom-control-label" for="size-1">XS</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-2" name="size">
                                <label class="custom-control-label" for="size-2">S</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-3" name="size">
                                <label class="custom-control-label" for="size-3">M</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-4" name="size">
                                <label class="custom-control-label" for="size-4">L</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-5" name="size">
                                <label class="custom-control-label" for="size-5">XL</label>
                            </div> --}}
                        </form>
                    </div>
                    
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus subtrac butchange">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center inputquantity" value="0">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus add butchange">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3 addtocart"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        {{-- <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a> --}}
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                        </div>
                        {{-- <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                      </ul> 
                                </div>
                            </div>
                        </div> --}}
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <h4 class="mb-4">1 review for "Product Name"</h4>
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                        </div>
                                    </div>
                                </div> --}}
                                
                                <form action="{{route('product.rateproduct')}}" id="formreview" class="col-md-12">
                                    @csrf
                                    <input type="text" class="d-none" name="id" value={{$product['id']}}>
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div id="starrate"></div>
                                        <input type="number" class="" id="rate" name="rate">
                                    </div>
                                    <div>
                                        <div class="form-group row">
                                            <div class='col-6'>
                                                <label for="message">Your Review *</label>
                                                <textarea id="message" name="review" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                               {{-- <div class='col-6'>
                                                <label for="name">Your Name *</label>
                                                <input type="text" class="form-control" name="name" id="name">
                                            </div> --}}
                                        </div>
                                        <div class="form-group row">
                                                {{-- <div class='col-6'>
                                                <label for="email">Your Email *</label>
                                                <input type="email" class="form-control" name="email" id="email">
                                            </div> --}}
                                            <div class='col-6' style="margin-top: 32px">
                                                <input type="button" value="Leave Your" class="btn btn-primary px-3 rating">
                                            </div>
                                        </div>
                                        {{-- {{auth()->check()?'':'disabled'}} --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @forelse ($productSuggest as $item)
                        <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src={{ asset("storage/".$item['img'][0]['path'])}} alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$item['name']}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$item['priceSell']}}</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    @empty
                        
                    @endforelse
                    
                    </div>
                    {{-- <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src={{ asset("img/product-2.jpg")}} alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src={{ asset("img/product-3.jpg")}} alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src={{ asset("img/product-4.jpg")}} alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src={{ asset("img/product-5.jpg")}} alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
   @endsection
   @push('js')
   {{-- <script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script> --}}
   <script src="{{asset('js/rating-star-icons/dist/rating.js')}}"></script>
        <script>
            $('.rating').click(function(){
                var form = $('#formreview');
                var actionUrl = form.attr('action');
                console.log('dd')        
               $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                    }
                });
            })
              $(function(){
                    $("#starrate").rating({
                            "half":true,
                            "click":function (e) {
                                $('#rate').val(e.stars)
                    }
                    });
                });
            $("#message").click(function(){
                console.log($('#starrate').val())
            })    
            $('.addtocart').click(function(){
                let id=$('#idProduct').val()
                let color=$("input[type='radio'].color:checked").val()
                let size=$("input[type='radio'].size:checked").val()
                let quantity=$('.inputquantity').val()
                $.ajax({
                    url: "{{route('cart.addtocart')}}",
                    type: 'GET',
                    data:{
                        id:id,
                        color:color,
                        size:size,
                        quantity:quantity
                    },
                    success: function(response) {
                        console.log(response)
                        $('.inputquantity').val(0)
                        $("input[type='radio'].size:checked").attr('data-quantity',response[1])
                        enableButton($('.btn-minus'),true)
                        enableButton($('.addtocart'),true)
                    },
                    error: function(response) {
                    
                    }
                });
            })
            function changeRadio(){
                let data=$("input[type='radio'].color:checked").val()
                let id=$("#idProduct").val()
                console.log('data',data)
                $.ajax({
                    url: "{{route('product.getsizeandimg')}}",
                    type: 'GET',
                    data:{
                        id:id,
                        color:data
                    },
                    success: function(response) {
                        let textSize=''
                         let textImg=''
                         let check=false;
                        console.log(response)
                        response[1].forEach((element,index) => {
                            textImg+=`<div class="carousel-item ${index==0?'active':''}">
                            <img class="w-100 h-100" src=http://localhost/Shop_clothes/public/storage/${element.path} alt="Image">
                        </div>`
                        });
                        // // console.log('length',Object.keys(response[2]).length);
                        // if(response[2].length>0){
                        //     check=true
                        // }
                        response[0].forEach((element,index) => {
                            let count=0
                            if(Object.keys(response[2]).length){
                            count=response[2].products.hasOwnProperty(element.idProduct+'_'+element.id) ? response[2].products[element.idProduct+'_'+element.id].quantity:0
                            }
                            console.log(count)
                            textSize+=`<div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input size"
                                 data-quantity=${element.quantity-count}
                                  value=${element.id} id="size-${element.id}" name="size">
                                <label class="custom-control-label" for="size-${element.id}">${element.name}</label>
                            </div>`
                        });
                         enableButton($('.butchange'),true)
                         document.getElementById('listImg').innerHTML = textImg;
                         document.getElementById('listSize').innerHTML = textSize;
                         $('.size').change(function(){
                            if($("input[type='radio'].size:checked").length>0){
                                if($("input[type='radio'].size:checked").attr('data-quantity')!=0){
                                    $(".inputquantity").val(1)
                                    enableButton($('.btn-plus'),false)
                                    enableButton($('.btn-minus'),false)
                                    enableButton($('.addtocart'),false)
                                }else{
                                    $("input[type='radio'].size:checked").val(0)
                                    enableButton($('.btn-plus'),true)
                                    enableButton($('.btn-minus'),true)
                                    enableButton($('.addtocart'),true)
                                }
                                
                            }
                        })
                    },
                    error: function(response) {
                    
                    }
                });
            }
            function activeAddtoCart(){

            }
           
            $('.addtocart').attr('disabled',true)
             //changeRadio()
             $('.color').change(function(){
                changeRadio()
             })
             function enableButton(e,status){
                e.attr('disabled',status)
             }
            //  $('.inputquantity').change(function(){
            //     let maxdata=parseInt($("input[type='radio'].size:checked").val())
            //     let data=parseInt($(this).val())
            //     console.log(maxdata,data)
            //     if(data>maxdata){
            //         enableButton($('.add'),true)
            //     }else if(data<=0){
            //         enableButton($('.subtrac'),true)
            //     }else{
            //         enableButton($('.butchange',false))
            //     }
            //  })
            enableButton($('.butchange'),true)
            $('.butchange').on('click', function () {
                var button = $(this);
                let maxdata=parseInt($("input[type='radio'].size:checked").attr('data-quantity'))
                console.log(maxdata)
                var oldValue = button.parent().parent().find('input').val();
                if (button.hasClass('btn-plus')) {
                    if(parseFloat(oldValue) + 1>maxdata){
                       enableButton($(this),true)
                       enableButton($('.addtocart'),true)
                    }else{
                        enableButton($('.btn-minus'),false)
                         enableButton($('.addtocart'),false)
                        var newVal = parseFloat(oldValue) + 1;
                        button.parent().parent().find('input').val(newVal);
                }
                } else {
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                        enableButton($('.btn-plus'),false)
                        enableButton($('.addtocart'),false)
                    } else {
                        newVal = 0;
                        enableButton($(this),true)
                        enableButton($('.addtocart'),true)
                    }
                    button.parent().parent().find('input').val(newVal);
                }
                
            });
        </script>
   @endpush