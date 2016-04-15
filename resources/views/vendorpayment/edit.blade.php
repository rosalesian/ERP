@extends('layout.content_template')

@section('title')
Create New Vendor Payment
@stop

@section('content-header')
<h1>Vendor Payment</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>

@stop

@section('content')
 <div class="row">
  <div class="col-md-12">
    {!! Form::open(array('url'=>'vendorpayment/'.$vendorpayment->id,'method'=>'put')) !!}

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('vendorpayment','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

    @inject('items', 'Nixzen\Repositories\ItemRepository')
    @inject('vendor', 'Nixzen\Repositories\VendorRepository')
    <div id="mainVP-container"></div>

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('vendorpayment','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

  {!! Form::close() !!}
  </div><!-- /.col -->
</div><!-- /.row -->

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
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/displayLineComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/textLineComponent.js') }}"></script>

<!-- FORM COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/forms/vendorpayment/vendorpayment_view.js') }}"></script>
<script type="text/babel">
var vendorpayments = <?php echo $vendorpayment?>;
var context="edit";
var lists = {
'items' : <?php echo $items->lists('description','id'); ?>,
'vendors' : <?php echo $vendor->lists('name','id'); ?>
};

ReactDOM.render(<VPMainComponent
context={context}
data={(typeof vendorpayments=='undefined') ? [] : vendorpayments}
lists={lists}/>,
document.getElementById("mainVP-container"));

</script>
</script>
@stop
