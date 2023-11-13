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

                <form action="{{url('update/category',$edit_category->id)}}" method="post">
                    @csrf
                    <input type="text" name="category" value="{{$edit_category->category}}" placeholder="Add Category"/>


                    <input type="submit" value="update Category" />

                </form><br><br>

            </div>
</div>
<!-- js -->
@include('admin.Js')
<!-- End_js  -->
</body>
</html>
