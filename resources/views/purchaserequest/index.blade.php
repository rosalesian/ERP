@extends('layout.content_template')

@section('title')
List of Purchase Requisitions
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
        <a href="{{url('transactions/purchaserequest/create ')}}" class="btn btn-block btn-primary btn-flat">New Purchase Requisition</a>
      </div>
   </div>

    <div class="box box-primary">
      <div class="box-header with-border">
              <h3 class="box-title"> </h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
      </div>
      <div class="box-body">
                <table id="example1"class="cell-border display nowrap dataTable no-footer" cellspacing="0" width="100%" role="grid" style="margin-left: 0px; width: 1073px;">
                  <thead>
            <tr role="row">
              <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 74px;" aria-sort="ascending" aria-label="First name: activate to sort column descending">
                ACTION
              </th>
              <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 72px;" aria-label="Last name: activate to sort column ascending">
                INTERNAL ID
              </th>
              <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 174px;" aria-label="Position: activate to sort column ascending">
                NAME
              </th>
              <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 76px;" aria-label="Office: activate to sort column ascending">
                REQUESTING DEPARTMENT
              </th>
              <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 27px;" aria-label="Age: activate to sort column ascending">
                PR#
              </th>
              <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 68px;" aria-label="Start date: activate to sort column ascending">
                DATE
              </th>
              <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 56px;" aria-label="Salary: activate to sort column ascending">
                TYPE
              </th>
            </tr>
          </thead>
                <tbody>
                <tr role="row" class="odd">
                  <td><a href="{{ url('transactions/purchaserequest/1/edit') }}">Edit</a> <small>|</small> <a href="{{ url('transactions/purchaserequest/1') }}">View</a></td>
                  <td class="sorting_1">123456789</td>
                  <td>JESSEL LOU ENTIA (emp)</td>
                  <td>Branches : Operations : Logistics : Good Stock Warehouse</td>
                  <td>PR13-07-03931</td>
                  <td>7/12/2014</td>
                  <td>Repairs and Maintenance - FLEET - Branch</td>
                </tr>
                 <tr role="row" class="odd">
                  <td><a href="{{ url('transactions/purchaserequest/1/edit') }}">Edit</a> <small>|</small> <a href="{{ url('transactions/purchaserequest/1') }}">View</a></td>
                  <td class="sorting_1">123456789</td>
                  <td>JESSEL LOU ENTIA (emp)</td>
                  <td>Branches : Operations : Logistics : Good Stock Warehouse</td>
                  <td>PR13-07-03931</td>
                  <td>7/12/2014</td>
                  <td>Repairs and Maintenance - FLEET - Branch</td>
                </tr>
                 <tr role="row" class="odd">
                  <td><a href="{{ url('transactions/purchaserequest/1/edit') }}">Edit</a> <small>|</small> <a href="{{ url('transactions/purchaserequest/1') }}">View</a></td>
                  <td class="sorting_1">123456789</td>
                  <td>JESSEL LOU ENTIA (emp)</td>
                  <td>Branches : Operations : Logistics : Good Stock Warehouse</td>
                  <td>PR13-07-03931</td>
                  <td>7/12/2014</td>
                  <td>Repairs and Maintenance - FLEET - Branch</td>
                </tr>
                 <tr role="row" class="odd">
                  <td><a href="{{ url('transactions/purchaserequest/1/edit') }}">Edit</a> <small>|</small> <a href="{{ url('transactions/purchaserequest/1') }}">View</a></td>
                  <td class="sorting_1">123456789</td>
                  <td>JESSEL LOU ENTIA (emp)</td>
                  <td>Branches : Operations : Logistics : Good Stock Warehouse</td>
                  <td>PR13-07-03931</td>
                  <td>7/12/2014</td>
                  <td>Repairs and Maintenance - FLEET - Branch</td>
                </tr>
                 <tr role="row" class="odd">
                  <td><a href="{{ url('transactions/purchaserequest/1/edit') }}">Edit</a> <small>|</small> <a href="{{ url('transactions/purchaserequest/1') }}">View</a></td>
                  <td class="sorting_1">123456789</td>
                  <td>JESSEL LOU ENTIA (emp)</td>
                  <td>Branches : Operations : Logistics : Good Stock Warehouse</td>
                  <td>PR13-07-03931</td>
                  <td>7/12/2014</td>
                  <td>Repairs and Maintenance - FLEET - Branch</td>
                </tr>
                 <tr role="row" class="odd">
                  <td><a href="{{ url('transactions/purchaserequest/1/edit') }}">Edit</a> <small>|</small> <a href="{{ url('transactions/purchaserequest/1') }}">View</a></td>
                  <td class="sorting_1">123456789</td>
                  <td>JESSEL LOU ENTIA (emp)</td>
                  <td>Branches : Operations : Logistics : Good Stock Warehouse</td>
                  <td>PR13-07-03931</td>
                  <td>7/12/2014</td>
                  <td>Repairs and Maintenance - FLEET - Branch</td>
                </tr>
                 <tr role="row" class="odd">
                  <td><a href="{{ url('transactions/purchaserequest/1/edit') }}">Edit</a> <small>|</small> <a href="{{ url('transactions/purchaserequest/1') }}">View</a></td>
                  <td class="sorting_1">123456789</td>
                  <td>JESSEL LOU ENTIA (emp)</td>
                  <td>Branches : Operations : Logistics : Good Stock Warehouse</td>
                  <td>PR13-07-03931</td>
                  <td>7/12/2014</td>
                  <td>Repairs and Maintenance - FLEET - Branch</td>
                </tr>
                 <tr role="row" class="odd">
                  <td><a href="{{ url('transactions/purchaserequest/1/edit') }}">Edit</a> <small>|</small> <a href="{{ url('transactions/purchaserequest/1') }}">View</a></td>
                  <td class="sorting_1">123456789</td>
                  <td>JESSEL LOU ENTIA (emp)</td>
                  <td>Branches : Operations : Logistics : Good Stock Warehouse</td>
                  <td>PR13-07-03931</td>
                  <td>7/12/2014</td>
                  <td>Repairs and Maintenance - FLEET - Branch</td>
                </tr>
                 <tr role="row" class="odd">
                  <td><a href="{{ url('transactions/purchaserequest/1/edit') }}">Edit</a> <small>|</small> <a href="{{ url('transactions/purchaserequest/1') }}">View</a></td>
                  <td class="sorting_1">123456789</td>
                  <td>JESSEL LOU ENTIA (emp)</td>
                  <td>Branches : Operations : Logistics : Good Stock Warehouse</td>
                  <td>PR13-07-03931</td>
                  <td>7/12/2014</td>
                  <td>Repairs and Maintenance - FLEET - Branch</td>
                </tr>
                 <tr role="row" class="odd">
                  <td><a href="{{ url('transactions/purchaserequest/1/edit') }}">Edit</a> <small>|</small> <a href="{{ url('transactions/purchaserequest/1') }}">View</a></td>
                  <td class="sorting_1">123456789</td>
                  <td>JESSEL LOU ENTIA (emp)</td>
                  <td>Branches : Operations : Logistics : Good Stock Warehouse</td>
                  <td>PR13-07-03931</td>
                  <td>7/12/2014</td>
                  <td>Repairs and Maintenance - FLEET - Branch</td>
                </tr>
                 <tr role="row" class="odd">
                  <td><a href="{{ url('transactions/purchaserequest/1/edit') }}">Edit</a> <small>|</small> <a href="{{ url('transactions/purchaserequest/1') }}">View</a></td>
                  <td class="sorting_1">123456789</td>
                  <td>JESSEL LOU ENTIA (emp)</td>
                  <td>Branches : Operations : Logistics : Good Stock Warehouse</td>
                  <td>PR13-07-03931</td>
                  <td>7/12/2014</td>
                  <td>Repairs and Maintenance - FLEET - Branch</td>
                </tr>
              </tbody>
              </table>
      </div><!-- ./box-body -->
    </div><!-- /.box -->

  </div><!-- /.col -->
</div><!-- /.row -->  
@stop

@section('scripts')

<!-- Data Tables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>  
<script src="{{ asset('js/custom_utilities/customDataTables.js') }}"></script>

@stop