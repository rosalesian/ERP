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
    
    <div class="box box-primary">
      <div class="box-header with-border">
              <h3 class="box-title">Primary Information</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
      </div>
      <div class="box-body">
          <!-- FIRST ROW -->
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>CUSTOM FORM</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->

           <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>TYPE</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>NEXT APPROVER ROLE</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- SECOND ROW -->
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>PR#</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>DATE</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>PLATE NO.</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- THIRD ROW -->
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>REQUESTING DEPARTMENT</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->

           <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>DELIVERED TO</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->

           <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>LOCATION</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- FORTH ROW -->
          <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                  <label>REMARKS</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->

           <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>TOTAL AMOUNT</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->  

      </div><!-- ./box-body -->
    </div><!-- /.box -->
    <div class="box box-primary">
      
      <div class="box-header with-border primaryinformation">
              <h3 class="box-title">Classification</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
      </div>
      <div class="box-body">
          <!-- Info boxes -->
          <div class="row">
           <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>PRINCIPAL</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>PO DATE</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->

            <div class="col-md-4 col-sm-6 col-xs-12">
              <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>NAME OF REQUESTER</label><br>
                    <span>Alabama</span>
                  </div><!-- /.form-group -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.box-body -->
            </div><!-- /.col -->
          </div><!-- /.row -->
      </div><!-- ./box-body -->
    </div><!-- /.box -->

    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Item</a></li>
        <li><a href="#tab_2" data-toggle="tab">File</a></li>
        <li><a href="#tab_3" data-toggle="tab">Notes</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
              <div id="line-items"></div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">

          <div id="sublist-items"></div>

        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
          Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
          when an unknown printer took a galley of type and scrambled it to make a type specimen book.
          It has survived not only five centuries, but also the leap into electronic typesetting,
          remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
          sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
          like Aldus PageMaker including versions of Lorem Ipsum.
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>

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