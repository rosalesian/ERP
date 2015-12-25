<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="../../favicon.ico">

    <title>{{ $page_header or 'GKH-ERP'}}</title>

    <!-- CSS scripts -->
    @include('layout.main-css')

  </head>

  <body>
     <!-- TOP navbar -->
  	@include('layout.main-topbar')

    <!-- CONTAINER -->
    <div class="container-fluid">
      <div class="row">

      <!-- SIDE navbar -->
      @include('layout.main-sidebar',[
        'links'=>[
          ['label' => 'Home', 'url' => '/'],
          ['label' => 'Create Purchase Request', 'url' => '/purchaserequest/create'],
          ['label' => 'List of Purchase Request', 'url' => '/purchaserequest'],
          ['label' => 'Create Purchase Order', 'url' => '/purchaseorder/create'],
          ['label' => 'List of Purchase Order', 'url' => '/purchaseorder']    
        ]
      ])     

        <!-- CONTENT -->
      	@yield('content')

      </div>
    </div>

    <!-- JavaScripts -->
    @include('layout.main-js')

  </body>
</html>
