@extends('layout.content_template')

@section('title')
Create New Purchase Requisition
@stop

@section('content-header')
<h1>Purchase Requisition</h1>
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
        {!! HTML::link('purchaserequest/'.$purchaserequest->id.'/edit','Edit',array('class'=>'btn btn-block btn-success btn-flat')) !!}
      </div>
      <div class="trans-button">
        {!! HTML::link('purchaserequest','Back',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
       <div class="trans-button">
        {!! HTML::link('purchaserequest/'.$purchaserequest->id,'Approve',array('class'=>'btn btn-block btn-primary btn-flat')) !!}
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
        {!! HTML::link('purchaserequest/'.$purchaserequest->id.'/edit','Edit',array('class'=>'btn btn-block btn-success btn-flat')) !!}
      </div>
      <div class="trans-button">
        {!! HTML::link('purchaserequest','Back',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
       <div class="trans-button">
        {!! HTML::link('purchaserequest/'.$purchaserequest->id.'/purchaseorder/create','Approve',array('class'=>'btn btn-block btn-primary btn-flat')) !!}
      </div>
    </div >

  </div><!-- /.col -->
</div><!-- /.row -->

<!-- canvass modal -->
<div class="example-modal" style="width:900px;"> <div class="modal" id="myModal"></div> </div>

<?php
$items=[];
foreach ($purchaserequest->items as $key) {
  array_push($items, [
          "_token"=> csrf_token(),
          "id"=>$key->id,
          "item_id"=>$key->item_id,
          "item_label"=>$key->item->itemcode,
          "description"=>$key->item->description,
          "quantity"=>$key->quantity,
          "unit_id"=>$key->unit_id,
          "uom_label"=>$key->unit->abbreviation,
          "canvasses"=>json_encode(getCanvass($key->canvasses))
  ]);
}

function getCanvass($canvasses) {
  $canvasslists=[];
  foreach($canvasses as $canvass) {
   array_push($canvasslists,[
        'id'=>(string) $canvass->id,
        'vendor_id'=>$canvass->vendor_id,
        'vendor_id_label'=>$canvass->vendor->name,
        'terms_id'=>$canvass->terms_id,
        'terms_id_label'=>$canvass->term->name,
        'cost'=>$canvass->cost,
        'purchaserequestitem_id'=>$canvass->purchaserequestitem_id,
        'approve'=>$canvass->approve
      ]);
  }
  return $canvasslists;
}
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
<!-- FORM COMPONENT -->
<script type="text/babel" src="{{ asset('js/react/forms/purchaserequisition/purchaserequisition_view.js') }}"></script>
<script type="text/babel">
  var purchaserequests = <?php echo $purchaserequest?>;
  var items= <?php echo json_encode($items); ?>;
  var context="view";
  ReactDOM.render(<PRMainComponent context={context} data={(typeof purchaserequests=='undefined') ? [] : purchaserequests}
    items={items} />, document.getElementById("mainPR-container"));
</script>
@stop
