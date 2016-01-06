<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    @foreach($links as $link)
      <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
    @endforeach()
  </ul>
</div>