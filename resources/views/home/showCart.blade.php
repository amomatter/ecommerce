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

    <div class="table_all">
        @include('admin.cssANDjsForTable')
        <div class="datatable-container">

            <!-- ======= Table ======= -->
            <table class="datatable">
                <thead>
                <tr>
                    <th><input type="checkbox" /></th>
                    <th>#</th>
                    <th>name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>address</th>
                    <th>product_title</th>
                    <th>quantity</th>
                    <th>price</th>
                    <th>image</th>
                    <th>Actions</th>

                </tr>
                </thead>

                <tbody>
                <?php
                $i=0;
                $i++
                ?>
                <?php
                $total=0;
                ?>

                @foreach($carts as $cart)
                    <tr>
                        <td><input type="checkbox" /></td>

                        <td>{{$i++}}</td>
                        <td>{{$cart->name}}</td>
                        <td>{{$cart->email}}</td>
                        <td>{{$cart->phone}}</td>
                        <td>{{$cart->address}}</td>
                        <td>{{$cart->product_title}}</td>
                        <td>{{$cart->quantity}}</td>
                        <td>{{$cart->price}}</td>
                        <td><img width="50px" height="50px" src="{{ asset('product/'.$cart->image) }}"></td>
                        <td>

                            <a type="submit"  href="{{url('delete/cart',$cart->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>



                        </td>






                    </tr>
                    <?php
                     $total=$total+$cart->price;


                    ?>

                @endforeach



                </tbody>

            </table>



        </div>

        <div>
            <br>

            <div class="text-center">
                <h3>total price is  : ${{$total}}</h3>
            </div>
            <br>
            <div class="text-center">
                <a type="submit"  href="{{url('pay/Delivery')}}" class="btn btn-primary text-danger">Cash On Delivery</a>
                <a type="submit"  href="{{url('stripe',$total)}}" class="btn btn-primary text-danger">Pay Using Card</a>
            </div>
            <!-- slider section -->

        </div>
    </div>
</div>

<!-- footer start -->
@include('home.footer')
<!-- footer end -->



<!-- jQery -->
@include('home.Jqery')
<!-- jQery  end-->

</body>
</html>
