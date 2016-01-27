<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" style="font-family: 'Lato', sans-serif; font-size: 30px; color: #D9534F;" href="#">Miyama-Ryu Jujutsu</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
        @if(Auth::user())
          <li><a href="/admin">Inicio <span class="sr-only">(current)</span></a></li>
        @else
          <li><a href="/">Inicio <span class="sr-only">(current)</span></a></li>
        @endif


        @if(Auth::user())
          <li><a href="{{ route('admin.practicantes.index') }}">Practicantes</a></li>
          <li><a href="{{ route('admin.categories.index') }}">Categorías</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Artículos <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('admin.articles.index') }}">Todos</a></li>
              <li><a href="#">por usuario</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">por categoría</a></li>
              <li><a href="#">por etiquetas</a></li>
            </ul>
          </li>
          <li><a href="">Imágenes</a></li>
          <li><a href="{{ route('admin.tags.index') }}">Tags</a></li>
        @endif
      </ul>
<!--
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
-->
  @if(Auth::user())
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('admin.users.edit', Auth::user()->id ) }}">Mi Perfil</a></li>
            <li><a href="#">Cambiar Password</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('admin.users.index') }}">Administrar Usuarios</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{ route('admin.auth.logout') }}">Logout</a></li>
          </ul>
        </li>
      </ul>
  @else
    <ul class="nav navbar-nav navbar-right">
      <li><a href="{{ route('admin.auth.login') }}">Login</a></li>   
    </ul>
  @endif

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>