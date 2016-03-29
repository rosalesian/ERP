@extends('app')
@section('content')
 <div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Data Table With Full Features</h3>
      </div><!-- /.box-header -->
      <div class="box-body">
        <table id="joborder-table" class="table table-bordered table-striped">
          <thead>
             <tr>
                <th>OPTION</th>
                <th>ID</th>
                <th>DATE</th>
                <th>DEPARTMENT</th>
                <th>MEMO</th>
                <th>PREPARED BY</th>
                <th>APPROVAL STATUS</th>
                <th>NEXT APPROVAL</th>
                <th>TYPE OF MAINTENANCE</th>
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
        ajax: '{!! route('jobordertable.data') !!}',
        columns: [
            {data: 'action', name: 'action', orderable: false, searchable: false},
            { data: 'id', name: 'id'},
            { data: 'transdate', name: 'transdate'},
            { data: 'item_description', name: 'item_description' },
            { data: 'memo', name: 'memo' },
            { data: 'firstname', name: 'firstname' },
            { data: 'firstname', name: 'firstname' },
            { data: 'prc_description', name: 'prc_description' },
            { data: 'maintenance_description', name: 'maintenance_description' },
            { data: 'created_at', name: 'created_at' }
        ]
    });
});
</script>
@endpush