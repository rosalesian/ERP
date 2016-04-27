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
        {!! HTML::link('vendorbill','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

    @inject('items', 'Nixzen\Repositories\ItemRepository')
    @inject('departments', 'Nixzen\Repositories\DepartmentRepository')
    @inject('branches', 'Nixzen\Repositories\BranchRepository')
    @inject('divisions', 'Nixzen\Repositories\DivisionRepository')
    @inject('terms', 'Nixzen\Repositories\TermRepository')
    @inject('nontrades', 'Nixzen\Repositories\BillTypeNonTradeSubTypeRepository')
    @inject('billtypes', 'Nixzen\Repositories\BillTypeRepository')
    @inject('chartofaccounts', 'Nixzen\Repositories\ChartOfAccountRepository')
    @inject('approvalstatus', 'Nixzen\Repositories\ApprovalStatusRepository')
    @inject('postingperiods', 'Nixzen\Repositories\PostingPeriodRepository')

    <div id="vendorBill-container"></div>

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('vendorbill','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
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
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/summaryMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/inputMainComponent.js') }}"></script>
<!-- LINEITEM COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/inputLineComponent.js') }}"></script>

<script type="text/babel" src="{{ asset('js/react/forms/vendorbills/vendorbills_view.js') }}"></script>
<script type="text/babel">
  var lists = {
    'items' : <?php echo $items->lists('description','id'); ?>,
    'departments' : <?php echo $departments->lists('name','id'); ?>,
    'branches' : <?php echo $branches->lists('name', 'id'); ?>,
    'divisions' : <?php echo $divisions->lists('name', 'id'); ?>,
    'terms' : <?php echo $terms->lists('name', 'id'); ?>,
    'nontrades' : <?php echo $nontrades->lists('name', 'id'); ?>,
    'billtypes' : <?php echo $billtypes->lists('name', 'id'); ?>,
    'chartofaccounts' : <?php echo $chartofaccounts->lists('title', 'id');?>,
    'approvalstatus' : <?php echo $approvalstatus->lists('name', 'id');?>,
    'postingperiods' : <?php echo $postingperiods->lists('name', 'id');?>
  };

  console.log(lists);
var context = "create";
  ReactDOM.render(<VendorBillMainComponent context={context} 
  data={(typeof vendorbill=='undefined') ? {} : vendorbill} lists={lists} />, document.getElementById("vendorBill-container"));
 
</script>
@stop

