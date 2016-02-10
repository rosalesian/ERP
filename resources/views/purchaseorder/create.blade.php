@extends('layout.content_template')

@section('title')
Create New Purchase Order
@stop

@section('content-header')
<h1>Purchase Order</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
</ol>
@stop

@section('content')
 <div class="row">
  <div class="col-md-12">
    {!! Form::open(array('url'=>'transactions/purchaserequest','method'=>'post')) !!}

    <div class="transaction-buttons-container">
      <div class="trans-button">
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('transactions/purchaserequest','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
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
            <div class="col-md-12">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>PURCHASE ORDER TYPE</label>
                            <select class="form-control select2" name="customform">
                              <option selected="selected">Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                            </select>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>VENDOR</label>
                            <select class="form-control select2" name="customform">
                              <option selected="selected">Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                            </select>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>ORDER TYPE</label>
                            <select class="form-control select2" name="customform">
                              <option selected="selected">Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                            </select>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>DATE</label>
                            <input type="date" class="form-control" name="date" placeholder="To be Generated">
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                    </div><!-- /.col -->

                     <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>TERMS</label>
                            <select class="form-control select2" name="customform">
                              <option selected="selected">Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                            </select>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>PO#</label>
                            <select class="form-control select2" name="customform">
                              <option selected="selected">Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                            </select>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>APPROVAL STATUS</label>
                            <select class="form-control select2" name="customform">
                              <option selected="selected">Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                            </select>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                    </div><!-- /.col -->

                     <div class="col-md-4 col-sm-6 col-xs-12">
                      <div class="box-body">
                      <div class="row">
                        <div class="col-md-12">
                            <div class="summary-container">
                            <div class="summary-header">Summary</div>
                            <!-- /.box-header -->
                            <div class="summary-content">
                               <div class="row">
                                  <div class="col-md-4">
                                  Subtotal:
                                  </div>
                                  <div class="col-md-8" style="margin-left:-15px;">
                                  123456789.999123
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-4">
                                  VAT:
                                  </div>
                                  <div class="col-md-8" style="margin-left:-15px;">
                                  12345678910.56422367
                                  </div>
                                </div>
                                <div class="row" style="border-bottom:2px solid black; margin:0px 1px 0px 1px;"></div>
                                <div class="row">
                                    <div class="col-md-4">
                                    <strong>Total:</strong>
                                    </div>
                                    <div class="col-md-8" style="margin-left:-15px;">
                                    123123123123.324324324
                                    </div>
                                </div>
                                

                            </div><!-- /.summary-content -->
                            </div><!-- /.summary-container -->
                        </div><!-- /.col -->
                      </div><!-- /.row -->
                    </div><!-- /.box-body -->
                    </div><!-- /.col -->

          </div><!-- /.col -->

          </div>


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
        <div class="row">
            <div class="col-md-12"> 
                    <div class="col-md-4 col-sm-6 col-xs-12"> <!-- First Column -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>DEPARTMENT</label>
                            <select class="form-control select2" name="customform">
                              <option selected="selected">Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                            </select>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>PRINCIPAL</label>
                            <select class="form-control select2" name="customform">
                              <option selected="selected">Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                            </select>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>PAYMENT TYPE</label>
                            <select class="form-control select2" name="customform">
                              <option selected="selected">Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                            </select>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                      
                    </div><!-- /.End First Column -->

                    <div class="col-md-4 col-sm-6 col-xs-12"> <!-- Second Column -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>WAREHOUSE LOCATION</label>
                            <select class="form-control select2" name="customform">
                              <option selected="selected">Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                            </select>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>BRANCH TIN</label>
                            <select class="form-control select2" name="customform">
                              <option selected="selected">Alabama</option>
                              <option>Alaska</option>
                              <option>California</option>
                              <option>Delaware</option>
                              <option>Tennessee</option>
                              <option>Texas</option>
                              <option>Washington</option>
                            </select>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <label>BRANCH TIN</label>
                            <textarea class="form-control"></textarea>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                    </div><!-- /.end Second Column -->

                     <div class="col-md-4 col-sm-6 col-xs-12"><!-- Third Column -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <input type="checkbox" id="billedCheck"> <label for="billedCheck">BILLED?</label>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                      <div class="row">
                        <div class="box-body">
                          <div class="form-group">
                            <input type="checkbox" id="billedCheck"> <label for="billedCheck">RECEIVED?</label>
                          </div><!-- /.form-group -->
                       </div><!-- /.box-body -->
                      </div><!-- /.row -->
                    </div><!-- /.end Third Column -->

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
         <button class="btn btn-block btn-primary btn-flat">Save</button>
      </div>
      <div class="trans-button">
        {!! HTML::link('transactions/purchaserequest','Cancel',array('class'=>'btn btn-block btn-default btn-flat')) !!}
      </div>
    </div>

  {!! Form::close() !!}
  </div><!-- /.col -->
</div><!-- /.row -->  
@stop