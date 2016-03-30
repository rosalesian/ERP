@extends('layout.content_template')

@section('title')
Create New Vendor Bill
@stop

@section('content-header')
<h1>Vendor Bill</h1>
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
    {!! Form::open(array('url'=>'vendorbill','method'=>'post')) !!}

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <input type="submit" class="btn btn-block btn-primary btn-flat" value="Save"/>
      </div>
      <div class="trans-button">
        {!! HTML::link('purchaserequest','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

    <div id="vendorBill-container"></div>

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('purchaserequest','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

  {!! Form::close() !!}
      <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
      Launch demo modal
    </button> --}}

  </div><!-- /.col -->
</div><!-- /.row -->

<!-- canvass modal -->
<div class="example-modal" style="width:900px;"> <div class="modal" id="myModal"></div> </div>

@stop

@section('scripts')
<!-- REACT LIBRARY -->
<script src="{{ asset('js/react/react.min.js') }}"></script>
<script src="{{ asset('js/react/react-dom.min.js') }}"></script>
<script src="{{ asset('js/react/browser.min.js') }}"></script>

<!-- REACT PLUGINS -->
<script src="{{ asset('js/react/plugin/classnames/index.js') }}"></script> <!-- classnames -->
<script src="{{ asset('js/react/plugin/input-autosize/dist/react-input-autosize.min.js') }}"></script> <!-- input-autosize -->
<script src="{{ asset('js/react/plugin/react-select/dist/react-select.min.js') }}"></script> <!-- select -->

<!-- MAINLINE COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/components/mainLine-components/type.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/mainLine-components/date.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/mainLine-components/deliveredto.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/mainLine-components/remarks.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/mainLine-components/totalamount.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/mainLine-components/nameofrequester.js') }}"></script>

<!-- CUSTOM REACT COMPONENT -->
<script type="text/babel" src="{{ asset('js/react/components/line-items.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/pr_canvass_component.js') }}"></script>
{{-- <script type="text/babel" src="{{ asset('js/react/components/custom-input-component.js') }}"></script> --}}
<script type="text/babel" src="{{ asset('js/react/forms/vendorbills/vendorbills_view.js') }}"></script>


@stop
