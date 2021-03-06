@extends('app')
@section('content')
 <div class="row">
  <div class="col-xs-12">
  <div class="transaction-buttons-container">
      <div class="trans-button">
        <a href="{{url('vendorbill/create ')}}" class="btn btn-block btn-primary btn-flat">New Vendor Bill</a>
      </div>
   </div>
    <div class="box">
      <div class="box-header">
       
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="joborder-table" class="table table-bordered table-striped">
          <thead>
             <tr>
                <th>OPTION</th>
                 <th>ID</th>
                <th>VENDOR</th>
                <th>DEPARTMENT</th>
                <th>TRANSACTION #</th>
                <th>SUPPLIER NO</th>
                <th>DUE DATE</th>
                <th>BILL TYPE</th>
                <th>NONE TRADE</th>
                <th>CREATED AT</th>
            </tr>
          </thead>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->         
@stop

@push('scripts_index')
<script>
$(function() {
    $('#joborder-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('vendortable.data') !!}',
        columns: [
            {data: 'action', name: 'action', orderable: false, searchable: false},
            { data: 'id', name: 'id'},
            { data: 'vendor_name', name: 'vendor_name'},
            { data: 'department_name', name: 'department_name'},
            { data: 'transno', name: 'transno' },
            { data: 'suppliers_inv_no', name: 'suppliers_inv_no' },
            { data: 'duedate', name: 'duedate' },
            { data: 'name', name: 'name' },
            { data: 'non_trade_name', name: 'non_trade_name' },
            { data: 'created_at', name: 'created_at' }
        ]
    });
});
</script>
@endpush