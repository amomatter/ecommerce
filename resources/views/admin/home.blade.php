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

        <!-- main-panel -->
        @include('admin.main-panel')
        <!-- main-panel -->
    </div>
</div>
        <!-- js -->
          @include('admin.Js')
        <!-- End_js  -->
</body>
</html>
