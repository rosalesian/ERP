@extends('default', [
	'page_header'=>$page_header
])

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">{{ $page_header or 'List'}}</h1>

  	@yield('list')

  </div>
</div>
@stop