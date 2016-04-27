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
    {!! Form::open(array('url'=>'purchaserequest/'.$purchaserequest->id,'method'=>'put')) !!}

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('purchaserequest','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

    @inject('items', 'Nixzen\Repositories\ItemRepository')
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
  </div><!-- /.col -->
</div><!-- /.row -->
    <?php
    $lineitems=[];
    foreach ($purchaserequest->items as $key) {
        array_push($lineitems, [
                "id"=>(string) $key->id,
                "item_id"=>$key->item_id,
                "item_id_label"=>$key->item->itemcode,
                "description"=>$key->item->description,
                "quantity"=>$key->quantity,
                "unit_id"=>$key->unit_id,
                "unit_id_label"=>$key->unit->abbreviation
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
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/summaryMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/inputMainComponent.js') }}"></script>
<!-- LINEITEM COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/inputLineComponent.js') }}"></script>
<!-- FORM COMPONENT -->
<script type="text/babel" src="{{ asset('js/react/forms/purchaserequisition/purchaserequisition_view.js') }}"></script>
<script type="text/babel">
  var purchaserequests = <?php echo $purchaserequest; ?>;
  var lineitems= <?php echo json_encode($lineitems); ?>;
  var lists = {
    'items' : <?php echo $items->lists('description','id'); ?>
  };

  var context="edit";
  ReactDOM.render(<PRMainComponent
    context={context}
    data={(typeof purchaserequests=='undefined') ? [] : purchaserequests}
    items={lineitems}
    lists={lists}/>,
    document.getElementById("mainPR-container"));

</script>
@stop
