<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
        @include('layout.main-css') 
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    </head>
   <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('layout.main-topbar')
            @include('layout.main-sidebar')
            <!-- Content Wrapper. Contains page content -->
           
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  @yield('content-header')
                </section>

                <section class="content">
                    @yield('content')
                </section>

            </div><!-- /.content -->
            </div><!-- /.content-wrapper -->
           
        </div><!-- ./wrapper -->
        @include('layout.main-footer')
        @include('layout.main-js')
        @yield('scripts')

     <!-- page script -->
    <!--<script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>-->

    </body>
</html>