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
                    <label>CUSTOM FORM</label>
                    <select class="form-control select2">
                      <option selected="selected">Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select>
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
                    <label>TYPE</label>
                    <select class="form-control select2">
                      <option selected="selected">Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select>
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
                    <label>NEXT APPROVER ROLE</label>
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
                    <label>PR#</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="To be Generated" disabled>
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
                    <label>DATE</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" placeholder="To be Generated">
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
                    <label>PLATE NO.</label>
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
                    <label>REQUESTING DEPARTMENT</label>
                    <select class="form-control select2">
                      <option selected="selected">Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select>
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
                    <label>DELIVERED TO</label>
                    <select class="form-control select2">
                      <option selected="selected">Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select>
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
                    <label>LOCATION</label>
                    <select class="form-control select2">
                      <option selected="selected">Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select>
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
                  <label>REMARKS</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
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
                    <label>TOTAL AMOUNT</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="To be Generated">
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
                    <label>PRINCIPAL</label>
                    <select class="form-control select2">
                      <option selected="selected">Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select>
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
                    <label>PO DATE</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" disabled>
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
                    <label>NAME OF REQUESTER</label>
                    <select class="form-control select2">
                      <option selected="selected">Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select>
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
          <b>How to use:</b>

          <p>Exactly like the original bootstrap tabs except you should use
            the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
          A wonderful serenity has taken possession of my entire soul,
          like these sweet mornings of spring which I enjoy with my whole heart.
          I am alone, and feel the charm of existence in this spot,
          which was created for the bliss of souls like mine. I am so happy,
          my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
          that I neglect my talents. I should be incapable of drawing a single stroke
          at the present moment; and yet I feel that I never was a greater artist than now.
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          The European languages are members of the same family. Their separate existence is a myth.
          For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
          in their grammar, their pronunciation and their most common words. Everyone realizes why a
          new common language would be desirable: one could refuse to pay expensive translators. To
          achieve this, it would be necessary to have uniform grammar, pronunciation and more common
          words. If several languages coalesce, the grammar of the resulting language is more simple
          and regular than that of the individual languages.
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

  </div><!-- /.col -->
</div><!-- /.row -->
          
@stop