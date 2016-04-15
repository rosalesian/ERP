@extends('app')
@section('content')
 <div class="row">
  <div class="col-xs-12">
  <div class="transaction-buttons-container">
      <div class="trans-button">
        <a href="{{url('joborder/create ')}}" class="btn btn-block btn-primary btn-flat">New Job Order</a>
      </div>
   </div>

    <div class="box">
      <div class="box-header">
   
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="joborder-table" class="table table-condensed table-bordered table-striped">
          <thead>
             <tr>
                <th>OPTION</th>
                <th>ID</th>
                <th>DATE</th>
                <th>DEPARTMENT</th>
                <th>MEMO</th>
                <th>PREPARED BY</th>
                <th>TYPE OF MAINTENANCE</th>
                <th>PURCHASE REQUEST CATEGORIES</th>
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
        ajax: '{!! route('jobordertable.data') !!}',
        columns: [
            { data: 'action', name: 'action', orderable: false, searchable: false},
            { data: 'id', name: 'id'},
            { data: 'transdate', name: 'transdate'},
            { data: 'asset_name', name: 'asset_name'},
            { data: 'memo', name: 'memo' },
            { data: 'dept_name', name: 'dept_name'},
            { data: 'full_name', name: 'full_name' },
            { data: 'maintenance_description', name: 'maintenance_description' },
            { data: 'created_at', name: 'created_at' }
        ]
    });
});
</script>
@endpush