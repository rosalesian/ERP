@extends('layout.content_template')

@section('title')
Edit Job Order
@stop

@section('content-header')
<h1>Job Order</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>

@stop

@section('content')
 <div class="row">
  <div class="col-md-12">
    {!! Form::open(array('url'=>'joborder/'.$joborder->id,'method'=>'put')) !!}

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('joborder','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

    @inject('items2', 'Nixzen\Repositories\ItemRepository')
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
        {!! HTML::link('joborder','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

  {!! Form::close() !!}
  </div><!-- /.col -->
</div><!-- /.row -->
 <?php

      $labor_items = [];
      foreach($joborder->laborItems as $laboritem) {
         // dd($laboritem->jobOrderType->name);
          $temp = [];
          $temp['_token'] = csrf_token();
          $temp['id'] = $laboritem->id;
          $temp['item_id'] = $laboritem->item->id;
          $temp['item_label'] = $laboritem->item->description;
          $temp['jobtype_id'] = $laboritem->jobOrderType->id;
          $temp['jobtype_label'] = $laboritem->jobOrderType->name;
          $temp['joborder_id'] = $laboritem->joborder_id;
          $temp['noofdays_id'] = $laboritem->item->id;
          $temp['no_of_days'] = $laboritem->no_of_days;
          $temp['description'] = $laboritem->jobOrderType->description;
          $temp['quantity'] = $laboritem->item->id;
          $labor_items[] = $temp;
      }
    //dd($joborder->laborCost);
?>
@stop

@section('scripts')
<!-- REACT LIBRARY -->
{{-- <script src="{{ asset('js/react/react.min.js') }}"></script> --}}
<script src="{{ asset('js/react/react.js') }}"></script>
<script src="{{ asset('js/react/react-dom.min.js') }}"></script>
<script src="{{ asset('js/react/browser.min.js') }}"></script>

<!-- REACT PLUGINS -->
<script src="{{ asset('js/react/plugin/classnames/index.js') }}"></script> <!-- classnames -->
<script src="{{ asset('js/react/plugin/input-autosize/dist/react-input-autosize.min.js') }}"></script> <!-- input-autosize -->
<script src="{{ asset('js/react/plugin/react-select/dist/react-select.min.js') }}"></script> <!-- select -->

<!-- MAINLINE COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/selectMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/textMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/dateMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/textAreaMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/checkBoxMainComponent.js') }}"></script>

<!-- LINEITEM COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/item.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/uom.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/description.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/job_orders/quantity.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/repair_type.js') }}"></script>

<!-- CUSTOM REACT COMPONENT -->
<script type="text/babel" src="{{ asset('js/react/components/line-items.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/pr_canvass_component.js') }}"></script>

<script type="text/babel" src="{{ asset('js/react/forms/joborder/joborder_view.js') }}"></script>
<script type="text/babel">
  var joborder = <?php echo $joborder?>;
  var laborcost = <?php echo json_encode($labor_items);?>

  var lists = {
    'items' : <?php echo $items2->lists('description','id'); ?>,
    'maintenancetypes' : <?php echo $maintenancetypes->lists('name', 'id'); ?>,
    'prcategories': <?php echo $prcategories->lists('name', 'id');?>,
    'empployees': <?php echo $empployees->lists('name', 'id'); ?>,
    'assets' : <?php echo $assets->lists('name', 'id'); ?>
  };
  console.log(laborcost);
  var context="edit";
  ReactDOM.render(<JOMainComponent context={context}
  data={(typeof joborder=='undefined') ? [] : joborder} 
  lists={lists}
  laborcosts = {laborcost}/>, document.getElementById("mainPR-container"));
</script>

@stop
