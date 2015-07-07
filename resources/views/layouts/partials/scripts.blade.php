<!-- START SCRIPTS -->
<!-- START PLUGINS -->
{!! HTML::script("js/plugins/jquery/jquery.min.js") !!}
{!! HTML::script("js/plugins/jquery/jquery-ui.min.js") !!}
{!! HTML::script("js/plugins/bootstrap/bootstrap.min.js") !!}     
<!-- END PLUGINS -->

<!-- START THIS PAGE PLUGINS-->
{!! HTML::script("js/plugins/icheck/icheck.min.js") !!}
{!! HTML::script("js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js") !!}
{!! HTML::script("js/plugins/scrolltotop/scrolltopcontrol.js") !!}
  
@yield('additional-scripts')
<!-- START TEMPLATE -->
{{-- {!! HTML::script("js/settings.js") !!} ---}}

{!! HTML::script("js/plugins.js") !!}
{!! HTML::script("js/actions.js") !!}    
<!-- END TEMPLATE -->
<!-- END SCRIPTS -->         