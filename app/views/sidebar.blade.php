@section('sidebar')
<div class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{url('album/index')}}">Album</a></li>
        <li class="active"><a href="{{url('artist/index')}}">Artist</a></li>
        <li class="active"><a href="{{url('category/index')}}">Category</a></li>
        <li class="active"><a href="{{url('genre/index')}}">Genre</a></li>
        <li class="active"><a href="{{url('ressource/index')}}">Medium</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</div>
@show
