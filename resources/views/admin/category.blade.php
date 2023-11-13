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

                <form action="{{url('store/category')}}" method="post">
                    @csrf
                    <input type="text" name="category" placeholder="Add Category"/>


                    <input type="submit" value="Add Category" />
                </form><br><br>



                <div class="table_all">
                    @include('admin.cssANDjsForTable')
                    <div class="datatable-container">

                        <!-- ======= Table ======= -->
                        <table class="datatable">
                            <thead>
                            <tr>
                                <th><input type="checkbox" /></th>
                                <th>#</th>
                                <th>Category</th>
                                <th>Actions</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $i=0;
                            $i++
                            ?>
                            @foreach($categories as $category)

                                <tr>
                                    <td><input type="checkbox" /></td>

                                    <td>{{$i++}}</td>
                                    <td>{{$category->category}}</td>
                                    <td>

                                        <a href="{{url('edit/category',$category->id)}}" type="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a type="submit"  href="{{url('delete/category',$category->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>



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
</div>
        <!-- js -->
          @include('admin.Js')
        <!-- End_js  -->
</body>
</html>
