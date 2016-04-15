@extends('layout.content_template')

@section('title')
Create New Job Order
@stop

@section('content-header')
<h1>Create Job Order</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@stop

@section('content')
@if($errors->any())
  <ul class="alert alert-danger">
      @foreach($errors->all() as $error)
         <li> {{ $error }} </li>
      @endforeach
  </ul>
@endif
 <div class="row">
  <div class="col-md-12">
    {!! Form::open(array('url'=>'joborder','method'=>'post')) !!}

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <input type="submit" class="btn btn-block btn-primary btn-flat" value="Save"/>
      </div>
      <div class="trans-button">
        {!! HTML::link('purchaserequest','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>
    
    @inject('items', 'Nixzen\Repositories\ItemRepository')
    @inject('maintenancetypes', 'Nixzen\Repositories\MaintenanceTypeRepository')
    @inject('prcategories', 'Nixzen\Repositories\PurchaseRequestCategoryRepository')
    @inject('empployees', 'Nixzen\Repositories\EmployeeRepository')
    @inject('assets', 'Nixzen\Repositories\AssetsRepository')

    <div id="mainPR-container"></div>
    

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('purchaserequest','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

  {!! Form::close() !!}
      <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
      Launch demo modal
    </button> --}}

  </div><!-- /.col -->
</div><!-- /.row -->  

<!-- canvass modal -->
<div class="example-modal" style="width:900px;"> <div class="modal" id="myModal"></div> </div>

@stop

@section('scripts')
<!-- REACT LIBRARY -->
<script src="{{ asset('js/react/react.js') }}"></script>
<script src="{{ asset('js/react/react-dom.min.js') }}"></script>
<script src="{{ asset('js/react/browser.min.js') }}"></script>

<!-- REACT PLUGINS -->
<script src="{{ asset('js/react/plugin/classnames/index.js') }}"></script> <!-- classnames -->
<script src="{{ asset('js/react/plugin/input-autosize/dist/react-input-autosize.min.js') }}"></script> <!-- input-autosize -->
<script src="{{ asset('js/react/plugin/react-select/dist/react-select.min.js') }}"></script> <!-- select -->

<!-- MAINLINE COMPONENTS -->
<!-- MAINLINE COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/summaryMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/inputMainComponent.js') }}"></script>
<!-- LINEITEM COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/inputLineComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/forms/joborder/joborder_view.js') }}"></script>
<script type="text/babel">
 var lists = {
    'items' : <?php echo $items->lists('description','id'); ?>,
    'maintenancetypes' : <?php echo $maintenancetypes->lists('name', 'id'); ?>,
    'prcategories': <?php echo $prcategories->lists('name', 'id');?>,
    'empployees': <?php echo $empployees->lists('name', 'id'); ?>,
    'assets' : <?php echo $assets->lists('name', 'id'); ?>
  };
  console.log(lists);
var context = "create";
  ReactDOM.render(<JOMainComponent 
  context={context} 
  data={(typeof jonorder=='undefined') ? {} : jonorder} 
  lists={lists}/>, 
  document.getElementById("mainPR-container"));
</script>

@stop