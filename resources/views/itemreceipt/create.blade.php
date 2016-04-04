@extends('layout.content_template')

@section('title')
Create New Item Receipt
@stop

@section('content-header')
<h1>Item Receipt</h1>
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
    {!! Form::open(array('url'=>'purchaseorder/'.$purchaseorder->id.'/itemreceipt','method'=>'post')) !!}
    <div class="transaction-buttons-container">
      <div class="trans-button">
         <input type="submit" class="btn btn-block btn-primary btn-flat" value="Save"/>
      </div>
      <div class="trans-button">
        {!! HTML::link('purchaseorder/'.$purchaseorder->id.'/itemreceipt','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>
      
      <div id="mainIR-container"></div>

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('purchaseorder/'.$purchaseorder->id.'/itemreceipt','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

  {!! Form::close() !!}

  </div><!-- /.col -->
</div><!-- /.row -->  

<!-- canvass modal -->
<div class="example-modal" style="width:900px;"> <div class="modal" id="myModal"></div> </div>

<?php
    $items=[];
    foreach ($purchaseorder->items as $key) {
        array_push($items, [
                "purchaseorderitem_id"=>$key->item_id,
                "purchaseorderitem_label"=>$key->item->description,
                "description"=>$key->item->itemcode,
                "quantity_received"=>$key->quantity,
                "unit_id"=>$key->unit_id,
                "uom_label"=>$key->unit->abbreviation
          ]);
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
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/selectMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/textMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/dateMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/textAreaMainComponent.js') }}"></script>

<!-- LINEITEM COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/item.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/uom.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/description.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/quantity.js') }}"></script>

<!-- BASE LINE COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/displayLineComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/textLineComponent.js') }}"></script>

<!-- CUSTOM REACT COMPONENT -->
<script type="text/babel" src="{{ asset('js/react/components/line-items.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/forms/itemreceipt/itemreceipt_view.js') }}"></script>
<script type="text/babel">
  var purchaseorder = <?php echo $purchaseorder; ?>;
  var old_inputs = <?php echo json_encode(Input::old()); ?>;
  var context = "create";
  var items= <?php echo json_encode($items); ?>;
  ReactDOM.render(<IRMainComponent context={context} data={(typeof old_inputs=='undefined') ? [] : old_inputs} 
                  purchaseorder={purchaseorder}
                  items={items} />,
                  document.getElementById("mainIR-container"));
</script>

@stop