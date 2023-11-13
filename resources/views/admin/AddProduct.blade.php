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

                <form action="{{url('add/product')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Product title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="inputEmail3" placeholder="title"  autocomplete="off">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Product Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Description" id="inputPassword3" placeholder="Description">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Product price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" id="inputPassword3" placeholder="price">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Discount Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Discount" id="inputPassword3" placeholder="Discount">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Product Quantity</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"  name="Quantity" id="inputPassword3" placeholder="Quantity">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Product Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control"  name="image" id="inputPassword3">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Product Category</label>
                        <div class="col-sm-10">
                            <select name="Category">

                                <option selected disabled>select</option>
                                @foreach($categories as $category)
                                <option>{{$category->category}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>




                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
<!-- js -->
@include('admin.Js')
<!-- End_js  -->
</body>
</html>
