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
    $items=[];
    foreach ($purchaserequest->items as $key) {
        array_push($items, [
                "id"=>$key->id,
                "item_id"=>$key->item_id,
                "item_label"=>$key->item->description,
                "description"=>$key->item->itemcode,
                "quantity"=>$key->quantity,
                "unit_id"=>$key->unit_id,
                "uom_label"=>unittypeEdit($key->item->id,$key->unit_id)
          ]);
    }
function unittypeEdit($itemid, $unitid) {
  $data=[];
  if($itemid=='1') {
    $data=[
      ['value'=>1, 'label'=>'CS'],
      ['value'=>2, 'label'=>'PC']
    ];
  } else if($itemid=='2') {
    $data=[
      ['value'=>1, 'label'=>'CS'],
      ['value'=>2, 'label'=>'PACKS']
    ];
  } else if($itemid=='3') {
    $data=[
      ['value'=>1, 'label'=>'CS'],
      ['value'=>2, 'label'=>'BX']
    ];
  } else if($itemid=='4') {
    $data=[
      ['value'=>1, 'label'=>'CS'],
      ['value'=>2, 'label'=>'PACKS'],
      ['value'=>3, 'label'=>'BX']
    ];
  } else if($itemid=='5') {
    $data=[
      ['value'=>1, 'label'=>'CS'],
      ['value'=>2, 'label'=>'PCS'],
      ['value'=>3, 'label'=>'PACKS']
    ];
  }

  $f='';
  foreach($data as $d) {
    if($d['value']==$unitid) {
      $f = $d['label'];
    }
  }
  return $f;
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
<script type="text/babel" src="{{ asset('js/react/components/pr_canvass_component.js') }}"></script>
{{-- <script type="text/babel" src="{{ asset('js/react/components/custom-input-component.js') }}"></script> --}}

<script type="text/babel" src="{{ asset('js/react/forms/purchaserequisition/purchaserequisition_view.js') }}"></script>
<script type="text/babel">
  var purchaserequests = <?php echo $purchaserequest; ?>;
  var items= <?php echo json_encode($items); ?>;
  var context="edit";
  ReactDOM.render(<PRMainComponent context={context} data={(typeof purchaserequests=='undefined') ? [] : purchaserequests} items={items}/>, document.getElementById("mainPR-container"));
</script>
@stop
