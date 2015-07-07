<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
 	<meta charset="utf-8" />
 	<meta name="_token" content="{{ csrf_token() }}"/>
	<title>Nixzen - @yield('title')</title>

	{{-- styles --}}
	@include('layouts.partials.css')
</head>

<body>
	<div id="wrapper">
		{{-- top nav bar --}}
		@include('layouts.partials.topnav')

		{{-- sidebar --}}
		@include('layouts.partials.sidebar')

		<div id="page-wrapper">
			<div id="page-inner">
				@yield('content')
			</div>
		</div>

		{{-- javascripts --}}
		@include('layouts.partials.scripts')
	</div>
</body>
</html>