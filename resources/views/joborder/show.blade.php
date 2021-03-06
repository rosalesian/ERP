@extends('layout.content_template')

@section('title')
Job Order View
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

    <div class="transaction-buttons-container">
      <div class="trans-button">
        {!! HTML::link('joborder/'.$joborder->id.'/edit','Edit',array('class'=>'btn btn-block btn-success btn-flat')) !!}
      </div>
       <div class="trans-button">
        {!! HTML::link('joborder/'.$joborder->id.'/edit','Create Purchase Requesitions',array('class'=>'btn btn-block btn-primary btn-flat')) !!}
      </div>
      <div class="trans-button">
        {!! HTML::link('joborder','Back',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>
    <div class="approvaltransition">
      <ol class="breadcrumb">
      <li>Encoder</li>
      <li>Branch Finance Supervisor</li>
      <li>Branch Purchaser</li>
      <li class="active">Branch Finance Manager</li>
      <li>Corporate Purchaser</li>
      <li>CA</li>
      <li>CFO</li>
      <li>CEO</li>
      </ol>
    </div>

    <div id="mainPR-container"></div>

    <div class="transaction-buttons-container">
      <div class="trans-button">
        {!! HTML::link('joborder/'.$joborder->id.'/edit','Edit',array('class'=>'btn btn-block btn-success btn-flat')) !!}
      </div>
       <div class="trans-button">
        {!! HTML::link('joborder/'.$joborder->id.'/edit','Create Purchase Requesitions',array('class'=>'btn btn-block btn-primary btn-flat')) !!}
      </div>
      <div class="trans-button">
        {!! HTML::link('joborder','Back',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

  </div><!-- /.col -->
</div><!-- /.row -->

<!-- canvass modal -->
<div class="example-modal" style="width:900px;"> <div class="modal" id="myModal"></div> </div>

<?php

      $labor_items = [];
      foreach($joborder->laborItems as $laboritem) {
         // dd($laboritem->jobOrderType->name);
          $temp = [];
          $temp['_token'] = csrf_token();
          $temp['id'] = $laboritem->id;
          $temp['item_id'] = $laboritem->item->id;
          $temp['item_label'] = $laboritem->item->itemcode;
          $temp['jobtype_id'] = $laboritem->jobOrderType->id;
          $temp['jobtype_label'] = $laboritem->jobOrderType->name;
          $temp['no_of_days'] = $laboritem->no_of_days;
          $temp['description'] = $laboritem->jobOrderType->description;
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
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/summaryMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/inputMainComponent.js') }}"></script>

<!-- LINEITEM COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/inputLineComponent.js') }}"></script>

<!-- CUSTOM REACT COMPONENT -->
<script type="text/babel" src="{{ asset('js/react/components/pr_canvass_component.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/forms/joborder/joborder_view.js') }}"></script>
<script type="text/babel">
  var joborder = <?php echo $joborder?>;
  var laborcost = <?php echo json_encode($labor_items);?>;
  console.log(laborcost);
  var context="view";
  ReactDOM.render(<JOMainComponent context={context} 
  data={(typeof joborder=='undefined') ? [] : joborder} 
  laborcosts = {laborcost}/>, document.getElementById("mainPR-container"));
</script>


@stop
