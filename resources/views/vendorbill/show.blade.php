@extends('layout.content_template')

@section('title')
Vendor Bill View
@stop

@section('content-header')
<h1>Vendor Bill</h1>
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
                {!! HTML::link('vendorbill/'.$vendorbill->id.'/edit','Edit',array('class'=>'btn btn-block btn-success btn-flat')) !!}
            </div>
            <div class="trans-button">
                {!! HTML::link('vendorbill','Back',array('class'=>'btn btn-block btn-default btn-flat')) !!}
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
                {!! HTML::link('vendorbill/'.$vendorbill->id.'/edit','Edit',array('class'=>'btn btn-block btn-success btn-flat')) !!}
            </div>
            <div class="trans-button">
                {!! HTML::link('vendorbill','Back',array('class'=>'btn btn-block btn-default btn-flat')) !!}
            </div>
        </div>

    </div><!-- /.col -->
</div><!-- /.row -->

<?php

    $items = [];
    foreach($vendorbill->items as $item) {
        $temp=[];
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
        $temp['taxcode_label'] =$item->item->taxcode_id;
        $temp['unit_cost'] =$item->unit_cost;
        $items[] = $temp;
    }

    $expenses = [];
        foreach($vendorbill->expenses as $expense) {
            $temp=[];
            $temp['amount'] = $expense->amount;
            $temp['taxcode_label'] = $expense->taxcode->name;
            $temp['coa_label'] = $expense->coa->title;
            $temp['coa_id'] = $expense->coa->id;
            $temp['department_label'] = $expense->department->name;
            $temp['division_label'] = $expense->division->name;
            $temp['branch_label'] = $expense->branch->name;
            $temp['vendor_label'] = $expense->vendor->name;
            $temp['tax_amount'] = $expense->tax_amount;
            $temp['gross_amount'] = $expense->gross_amount;
            $expenses[] = $temp;
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

<!-- MAINLINE COMPONENTS -->
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/selectMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/textMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/dateMainComponent.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/main-line-components/textAreaMainComponent.js') }}"></script>

<!-- LINEITEM COMPONENTS -->


<script type="text/babel" src="{{ asset('js/react/components/line-items-components/item.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/vendor_bills/uom.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/vendor_bills/coa.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/vendor_bills/department.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/vendor_bills/division.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/vendor_bills/branch.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/vendor_bills/vendor.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/description.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/quantity.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/repair_type.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/amount.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/tax_amount.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/gross_amount.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/tax_code.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/line-items-components/unit_cost.js') }}"></script>


<!-- CUSTOM REACT COMPONENT -->
<script type="text/babel" src="{{ asset('js/react/components/line-items.js') }}"></script>
<script type="text/babel" src="{{ asset('js/react/components/pr_canvass_component.js') }}"></script>

<script type="text/babel" src="{{ asset('js/react/forms/vendorbills/vendorbills_view.js') }}"></script>
<script type="text/babel">
  var vendorbill = <?php echo $vendorbill?>;
  var items= <?php echo json_encode($items); ?>;
  var expenses = <?php echo json_encode($expenses);?>;
  console.log(expenses);

  var context="view";
  ReactDOM.render(<VendorBillMainComponent context={context} data={(typeof vendorbill=='undefined') ? [] : vendorbill} items={items} expenses = {expenses} />, document.getElementById("mainPR-container"));
</script>

<!-- <script type="text/babel" src="{{ asset('js/react/forms/vendorbill/vendorbill_view.js') }}"></script>
<script type="text/babel">
var context = "create";
  ReactDOM.render(<JOMainComponent context={context} />, document.getElementById("mainPR-container"));
</script> -->
@stop
