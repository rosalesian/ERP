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
        {!! HTML::link('transactions/purchaserequest/create','Edit',array('class'=>'btn btn-block btn-success btn-flat')) !!}
      </div>
      <div class="trans-button">
        {!! HTML::link('transactions/purchaserequest','Back',array('class'=>'btn btn-block btn-default btn-flat')) !!}
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
        {!! HTML::link('transactions/purchaserequest/create','Edit',array('class'=>'btn btn-block btn-success btn-flat')) !!}
      </div>
      <div class="trans-button">
        {!! HTML::link('transactions/purchaserequest','Back',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

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
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/type.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/date.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/deliveredto.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/remarks.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/totalamount.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/nameofrequester.js') }}"></script>

<!-- CUSTOM REACT COMPONENT -->
<script type="text/babel" src="{{ asset('js/react/components/line-items.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/pr_canvass_component.js') }}"></script>
{{-- <script type="text/babel" src="{{ asset('js/react/components/custom-input-component.js') }}"></script> --}}
<script type="text/babel" src="{{ asset('js/react/forms/purchaserequisition/purchaserequisition_view.js') }}"></script>
<script type="text/babel">
  var purchaserequests = <?php echo $purchaserequest; ?>;
  var context="view";
  ReactDOM.render(<PRMainComponent context={context} data={(typeof purchaserequests=='undefined') ? [] : purchaserequests} />, document.getElementById("mainPR-container"));
</script>
@stop