<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
            </h2>
            <form action="{{url('product_search')}}" method="get">
                @csrf
                <input type="text" name="search" placeholder="Search for any thing">
                <input type="submit" value="search">
            </form>
        </div>
        <div class="row">
            @foreach($products as $product)

            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box">
                    <div class="option_container">
                        <div class="options">

                            <a href="{{url('product/details',$product->id)}}" class="option1">
                                product Details
                            </a>

                            <form action="{{url('add_cart',$product->id)}}" method="post">
                                @csrf

                             <div>   <input style="border-radius: 48%" type="number" value="1" name="quantity"  min="1"></div>

                              <div>  <input type="submit" value="Add To Cart" class="option2">



                              </div>

                            </form>

                        </div>
                    </div>
                    <div class="img-box">
                        <img src="{{asset('product/'.$product->image)}}" alt="">
                    </div>
                    <div class="detail-box">
                        <h5>
                            {{$product->title}}
                        </h5>
                        <h6>
                            @if($product->discount_price==null)
                                ${{$product->price}}
                            @else
                                <del> ${{$product->price}} </del>
                            @endif

                        </h6>

                        @if($product->discount_price==null)

                        <h6>
                           ${{$product->price}}
                        </h6>
                        @else
                            <h6>
                                ${{$product->price - $product->discount_price}}
                            </h6>
                        @endif

                    </div>
                </div>
            </div>
            @endforeach

    </div>
    </div>
</section>
