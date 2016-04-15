{{-- all javascript files goes here --}}

<!-- jquery core -->
{!! HTML::script('/js/jquery-1.10.2.js') !!}
{!! HTML::script('/js/jquery-ui-1.10.2.js') !!}

  <!-- Bootstrap Js -->
{!! HTML::script('/js/bootstrap.min.js') !!}

<!-- Metis Menu Js -->
{!! HTML::script('/js/jquery.metisMenu.js') !!}

{{-- chart & graphs handler --}}
{!! HTML::script('/js/morris/morris.js')!!}
    
@yield('additional-scripts')

<!-- Custom Js -->
{!! HTML::script('js/custom-scripts.js') !!}