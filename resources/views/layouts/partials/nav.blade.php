<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
  <div class="dropdown">
    <a class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <img style="width:50px;height:60px;"  class="img-circle" src="{{ url('images/')}}/{{auth()->user()->image}}"/>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <li><a class="dropdown-item" href="{{url ('/contact/userEdit')}}">PROFILE</a></li>
      <li><a type="button" href= "{{url ('logout')}}" class="btn btn-danger">LOGOUT</a></li>
    </ul>
 </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="/contact/list">LIST CONTACT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/contact/add">ADD CONTACT</a>
        </li>
      </ul>
      <form class="d-flex" action="/contact/search" method="post" >
        <input class="form-control me-2" type="text" name="keyword" placeholder="Search">
        <button class="btn btn-primary" type="submit">Search</button>
        @csrf
      </form>

    </div>
  </div>
</nav>