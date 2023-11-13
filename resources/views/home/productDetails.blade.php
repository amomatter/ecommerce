<!DOCTYPE html>
<html>
<head>
    @include('home.head')
</head>
<body>
<div class="hero_area">
    <!-- header section strats -->
@include('home.header')
<!-- end header section -->


    <!-- slider section -->
@include('home.slider')
<!-- end slider section -->
</div>
<!-- why section -->
@include('home.why')
<!-- end why section -->

<!-- arrival section -->
@include('home.arrival')
<!-- end arrival section -->

<section class="product_section layout_padding">
    <div class="container">
<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="{{asset('product/'.$product->image)}}" alt="Card image cap">
    <div class="card-body">
        <p class="card-text">

            This is :{{$product->title}} <hr>
            description :{{$product->description}} <hr>
             the old price is :${{$product->price}} <hr>
             after discount the price is:   ${{ $product->price -$product->discount_price}} <hr>
             the category for this product is  :{{$product->category}} <hr>


        <a type="submit" href="{{url('/')}}" class="btn btn-outline-success"><i class="fa-solid fa-arrow-left"></i></a>
        <br>
        <br>
        <form action="{{url('add_cart',$product->id)}}" method="post">
            @csrf
            <div>   <input  type="number" value="1" name="quantity"  min="1"></div>

            <button  type="submit" class="btn btn-outline-success" > <i class="fa-solid fa-cart-shopping"></i>

            </button>

        </form>



        </p>
    </div>
</div>

    </div>
</section>


<!-- subscribe section -->
@include('home.subscribe')
<!-- end subscribe section -->

<!-- client section -->
@include('home.client')
<!-- end client section -->

<!-- footer start -->
@include('home.footer')
<!-- footer end -->



<!-- jQery -->
@include('home.Jqery')
<!-- jQery  end-->

</body>
</html>
