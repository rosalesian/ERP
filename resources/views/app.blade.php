<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dranix admin</title>
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
                    <h1>
                    Dashboard
                    <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
            </div><!-- /.content -->
            </div><!-- /.content-wrapper -->
           
        </div><!-- ./wrapper -->
 
        @include('layout.main-js')

    

     <!-- page script -->
    <script>
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
    </script>

    </body>
</html>