@extends('layout.content_template')

@section('title')
Edit New Vendor Bill
@stop

@section('content-header')
<h1>Edit Vendor Bill</h1>
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
      
         {!! Form::open(array('url'=>'vendorbill/'.$vendorbill->id,'method'=>'put')) !!}

        <div class="transaction-buttons-container">
            <div class="trans-button">
                <input type="submit" class="btn btn-block btn-primary btn-flat" value="Save"/>
            </div>
            <div class="trans-button">
                {!! HTML::link('vendorbill','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
            </div>
        </div>

        @inject('items2', 'Nixzen\Repositories\ItemRepository')
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
<?php

    $items = [];
    foreach($vendorbill->items as $item) {
        $temp=[];
        $temp['id'] = $item->id;
        $temp['quantity'] = $item->quantity;
        $temp['uom_label'] = $item->unit->abbreviation;
        $temp['uom_id'] = $item->unit->id;
        $temp['item_id'] = $item->item->id;
        $temp['description'] = $item->item->description;
        $temp['item_label'] = $item->item->itemType->name;
        $temp['amount'] = $item->amount;
        $temp['tax_amount'] =$item->tax_amount;
        //need to modefied
        $temp['gross_amount'] =$item->gross_amount;
        $temp['taxcode_id'] =$item->taxcode_id;
        $temp['taxcode_label'] = 'Hello Wolrd';
        $temp['unit_cost'] =$item->unit_cost;
        $items[] = $temp;
    }

  $expenses = [];
        foreach($vendorbill->expenses as $expense) {
            $temp=[];
            $temp['id'] = $expense->id;
            $temp['amount'] = $expense->amount;
            $temp['taxcode_label'] = $expense->taxcode->name;
            $temp['coa_label'] = $expense->coa->title;
            $temp['coa_id'] = $expense->coa->id;
            $temp['department_label'] = $expense->department->name;
            $temp['division_label'] = $expense->division->name;
            $temp['branch_label'] = $expense->branch->name;
            $temp['vendor_label'] = $expense->vendor->name;
            $temp['department_id'] = $expense->department->id;
            $temp['division_id'] = $expense->division->id;
            $temp['branch_id'] = $expense->branch->id;
            $temp['vendor_id'] = $expense->vendor->id;
            $temp['tax_amount'] = $expense->tax_amount;
            $temp['taxcode_id'] =$expense->taxcode_id;
            $temp['gross_amount'] = $expense->gross_amount;
            $expenses[] = $temp;
        }

?>

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
 
  var vendorbill = <?php echo $vendorbill?>;
  var items= <?php echo json_encode($items); ?>;
  var expenses = <?php echo json_encode($expenses);?>;

  var lists = {
    'items' : <?php echo $items2->lists('description','id'); ?>,
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
  console.log(items);
  var context="edit";
  ReactDOM.render(<VendorBillMainComponent 
    context={context} 
    lists={lists} 
    data={(typeof vendorbill=='undefined') ? [] : vendorbill} 
    items={items} expenses = {expenses}/>,  
    document.getElementById("vendorBill-container"));
</script>
@stop

