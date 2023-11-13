<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
</head>
<body>
<div class="container-scroller">
    <!-- sidebar -->
@include('admin.slider')
<!-- sidebar -->
    <div class="container-fluid page-body-wrapper">
        <!--navbar-->
    @include('admin.navbar')
    <!--navbar-->

        <div class="main-panel">
            <div class="content-wrapper">

                <form action="{{url('search')}}" method="get" >
                    @csrf
                    <input type="text" name="search" >

                    <button type="submit" class="btn btn-primary mb-2">search</button>
                </form>

                <div class="table_all">
                    @include('admin.cssANDjsForTable')
                    <div class="datatable-container">

                        <!-- ======= Table ======= -->
                        <table class="datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-primary">name</th>
                                <th  class="text-success">email</th>
                                <th class="text-danger">phone</th>
                                <th class="text-warning">address</th>
                                <th class="text-info">product title</th>
                                <th class="text-dark">quantity</th>
                                <th class="text-muted">price</th>
                                <th class="text-primary">image</th>
                                <th class="text-success">payment status</th>
                                <th class="text-danger">delivery status</th>
                                <th class="text-dark">Actions</th>
                                <th class="text-muted">print</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $i=0;
                            $i++
                            ?>
                            @foreach($orders as $order)

                                <tr>

                                    <td>{{$i++}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->email}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->address}}</td>
                                    <td>{{$order->product_title}}</td>
                                    <td>{{$order->quantity}}</td>
                                    <td>{{$order->price}}</td>
                                    <td><img width="50px" height="50px" src="{{asset('product/'.$order->image)}}"></td>
                                    <td>{{$order->payment_status}}</td>
                                    <td>{{$order->delivery_status}}</td>

                                    <td>
                                         @if($order->delivery_status=='processing')

                                        <a href="{{url('delivered',$order->id)}}" class="btn btn-success">Delivered</a>
                                        @else
                                        <p>delivered</p>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{url('print/pdf',$order->id)}}" class="btn btn-primary">invoice</a>

                                    </td>


                                </tr>



                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>


            </div>

        </div>
    </div>
</div>
<!-- js -->
@include('admin.Js')
<!-- End_js  -->
</body>
</html>
