<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">My Blogger</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100 " type="text" placeholder="Search" aria-label="Search">
    {{-- <div class="col md-5">
      <p style="color: white">{{ auth()->user()->name }}</p>
    </div> --}}
    <div class="navbar-nav">
      {{-- <div class="nav-item text-nowrap">
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="nav-link px-3 bg-dark border-0"> Logout <span data-feather= "log-out"></span></a></button>
        </form>
      </div> --}}
    </div>

      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        {{auth()->user()->name}}
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a class="dropdown-item" href="#"></a>
            <form action="/logout" method="post">
              @csrf
              <button type="submit" class="nav-link w-100 px-3 border-0"> Logout <span data-feather= "log-out"></span></a></button>
            </form>
          </li>
        </ul>
      </div>
  </header>