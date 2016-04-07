@extends('layout.content_template')

@section('title')
Create New Purchase Order
@stop

@section('content-header')
<h1>Purchase Order</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>

@stop

@section('content')
 <div class="row">
  <div class="col-md-12">
    {!! Form::open(array('url'=>'purchaseorder/'.$purchaseorder->id,'method'=>'put')) !!}

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('purchaseorder','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

    @inject('items', 'Nixzen\Repositories\ItemRepository')
    <div id="mainPO-container"></div>

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('purchaseorder','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

  {!! Form::close() !!}
  </div><!-- /.col -->
</div><!-- /.row -->
    <?php
    $lineitems=[];
    foreach ($purchaseorder->items as $key) {
        array_push($lineitems, [
            "id"=> (string) $key->id,
            "item_id"=>$key->item_id,
            "item_label"=>$key->item->description,
            "description"=>$key->item->itemcode,
            "quantity"=>$key->quantity,
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

<!-- CUSTOM REACT COMPONENT -->
<script type="text/babel" src="{{ asset('js/react/components/line-items.js') }}"></script>

<script type="text/babel" src="{{ asset('js/react/forms/purchaseorder/purchaseorder_view.js') }}"></script>
<script type="text/babel">
  var purchaseorders = <?php echo $purchaseorder; ?>;
  var lineitems= <?php echo json_encode($lineitems); ?>;
  var lists = {
    'items' : <?php echo $items->lists('description','id'); ?>
  };
  var context="edit";
  
  ReactDOM.render(<POMainComponent
  context={context} data={(typeof purchaseorders=='undefined') ? [] : purchaseorders}
  lists={lists}
  items={lineitems}/>, document.getElementById("mainPO-container"));
</script>
@stop
