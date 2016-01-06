{{-- css files --}}

<!-- Bootstrap Styles-->
{!! HTML::style('/css/app.css') !!}	

<!-- FontAwesome Styles-->
{!! HTML::style('/css/font-awesome.css') !!}	

<!-- Morris Chart Styles-->
{!! HTML::style('/js/morris/morris-0.4.3.min.css') !!}

<!-- Custom Styles-->
{!! HTML::style('/css/custom-styles.css') !!}

<!-- TABLE STYLES-->
{!! HTML::style('/js/dataTables/dataTables.bootstrap.css') !!}

@yield('additional-styles')