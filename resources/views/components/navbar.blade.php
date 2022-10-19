<nav class="navbar navbar-expand-lg shadow sticky-top">
  <div class="container d-flex @auth justify-content-between @endauth justify-content-center align-content-center">
      <a class="navbar-brand" href="/">
        <h3 class="title fs-1 fw-semibold"><span>Si</span>Pemikir</h3>
      </a>
      @auth
        <div class="dropdown">
          <a class="dropdown-toggle text-decoration-none text-dark p-0 m-0" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}" alt="" width="40" height="40" class="rounded-circle overflow-hidden">
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="dropdownMenuLink">
            <li><a class="dropdown-item" href="/dashboard/posts"><i class="bi bi-layout-text-window-reverse"></i> Dashboard</a></li>
            <li><a class="dropdown-item" href="/dashboard/users/{{ auth()->user()->username }}/edit"><i class="bi bi-person"></i> Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="/logout" method="post">
                @csrf
                <button type="submit" class="dropdown-item">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </button>
              </form>
            </li>
          </ul>
        </div>
      @endauth
   
  </div>
</nav>


     