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
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>@yield('form-title', 'Standard Form')</h2>
			</div>
			<div class="panel-body">				
				{!! Form::open( isset($form_params) ? $form_params : [] ) !!}

				{{-- top buttons --}}
				<div class="col-xs-12">
					@yield('buttons')
					<hr>
				</div>
				{{-- main line --}}
				@yield('main')

				{{-- tabs --}}
				<div class="col-xs-12">
					<div class="form-group">
						<div role="tab-panel">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#state" aria-controls="state" role="tab" data-toggle="tab">State</a>
								</li>
							</ul>

							<div class="tab-content">
								@yield('tabs')
							</div>
						</div>
					</div>
				</div>
				

				{{-- bottom buttons --}}
				<div class="col-xs-12">
					<hr>
					@yield('buttons')
				</div>
				

				{!! Form::close()!!}						
						
			</div>
		</div>
	</div>
</div>
	


@stop

@section('additional-scripts')
	{{-- script for handling line item will be added in here --}}

	{{-- form type specific scripts here--}}
	@yield('script-list')
@stop