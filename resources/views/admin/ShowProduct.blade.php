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

                <div class="table_all">
                    @include('admin.cssANDjsForTable')
                    <div class="datatable-container">

                        <!-- ======= Table ======= -->
                        <table class="datatable">
                            <thead>
                            <tr>
                                <th><input type="checkbox" /></th>
                                <th>#</th>
                                <th>title</th>
                                <th>description</th>
                                <th>price</th>
                                <th>quantity</th>
                                <th>category</th>
                                <th>discount_price</th>
                                <th>image</th>
                                <th>Actions</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $i=0;
                            $i++
                            ?>

                                @foreach($products as $product)
                                <tr>
                                    <td><input type="checkbox" /></td>

                                    <td>{{$i++}}</td>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->category}}</td>
                                    <td>{{$product->discount_price}}</td>
                                    <td><img width="50px" height="50px" src="{{ asset('product/'.$product->image) }}"></td>
                                    <td>

                                        <a href="{{url('edit/product',$product->id)}}" type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a type="submit"  href="{{url('delete/product',$product->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>



                                    </td>


                                </tr>
                                @endforeach



                            </tbody>

                        </table>
                    </div>

                    <div>

            <div>

        </div>
    </div>
</div>
<!-- js -->
@include('admin.Js')
<!-- End_js  -->
</body>
</html>
