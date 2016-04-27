@extends('layout.content_template')

@section('title')
View Vendor Payment
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

    <div class="transaction-buttons-container">
      <div class="trans-button">
        {!! HTML::link('vendorpayment/'.$vendorpayment->id.'/edit','Edit',array('class'=>'btn btn-block btn-success btn-flat')) !!}
      </div>
      <div class="trans-button">
        {!! HTML::link('vendorpayment','Back',array('class'=>'btn btn-block btn-default btn-flat')) !!}
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

    <div id="mainVP-container"></div>

    <div class="transaction-buttons-container">
      <div class="trans-button">
        {!! HTML::link('vendorpayment/'.$vendorpayment->id.'/edit','Edit',array('class'=>'btn btn-block btn-success btn-flat')) !!}
      </div>
      <div class="trans-button">
        {!! HTML::link('vendorpayment','Back',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

  </div><!-- /.col -->
</div><!-- /.row -->

<!-- canvass modal -->
<div class="example-modal" style="width:900px;"> <div class="modal" id="myModal"></div> </div>

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
var vendorpayments = <?php echo $vendorpayment; ?>;
var context="view";
console.log(vendorpayments);
ReactDOM.render(<VPMainComponent
context={context}
data={(typeof vendorpayments=='undefined') ? [] : vendorpayments} />,
document.getElementById("mainVP-container"));

</script>
@stop
