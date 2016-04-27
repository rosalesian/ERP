@extends('layouts.default')

@section('title')
	@yield('form-title', 'ERP')
@stop

@section('additional-styles')
	<style type="text/css">
		textarea {
			max-width: 20em;
			height: 4em;
		}
	</style>
	{{-- form specific styles --}}
	@yield('style-list')
@stop

@section('content')    
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">     
                    
            <div class="panel panel-default">           
            
                <div class="panel-heading">
                    <h3 class="panel-title">@yield('form-title')</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">                                                                       
                    
                    <div class="row">
                    	@yield('main')
                    </div>

                </div>
                <div class="panel-body panel-table">
                	<div>
                		@yield('line-item')      
                	</div>
                </div>
                <div class="panel-footer">
                	@yield('buttons')                	
                </div>
            
            </div>       
            
        </div>
    </div>                    
    
</div>
<!-- END PAGE CONTENT WRAPPER -->         
@stop

@section('additional-scripts')
	{{-- script for handling line item will be added in here --}}
    {!! HTML::script("js/plugins/bootstrap/bootstrap-datepicker.js") !!}   

    {!! HTML::script("js/plugins/bootstrap/bootstrap-file-input.js") !!} 
    {!! HTML::script("js/plugins/bootstrap/bootstrap-select.js") !!} 
    {!! HTML::script("js/plugins/tagsinput/jquery.tagsinput.min.js") !!} 
	{{-- form type specific scripts here--}}
	@yield('script-list')
@stop