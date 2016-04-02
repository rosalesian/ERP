@extends('app')
@section('content')
 <div class="row">
  <div class="col-xs-12">
  <div class="transaction-buttons-container">
      <div class="trans-button">
        <a href="{{url('purchaserequest/create ')}}" class="btn btn-block btn-primary btn-flat">New Purchase Request</a>
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
                <th>NAME OF REQUESTER</th>
                <th>REQUESTING DEPARTMENT</th>
                <th>TOTAL AMOUNT</th>
                <th>DATE</th>
                <th>REMARKS</th>
                <th>CREATED AT</th>
            </tr>
          </thead>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->         
@stop

@push('scripts')
<script>
$(function() {
    $('#joborder-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('prtable.data') !!}',
        columns: [
            { data: 'action', name: 'action', orderable: false, searchable: false},
            { data: 'id', name: 'id'},
            { data: 'name', name: 'name', searchable: true},
            { data: 'dep_name', name: 'dep_name', searchable: true,  orderable: true},
            { data: 'total_amount', name: 'total_amount' },
            { data: 'date', name: 'date' },
            { data: 'remarks', name: 'remarks' },
            { data: 'created_at', name: 'created_at' }
        ]
    });
});
</script>
@endpush