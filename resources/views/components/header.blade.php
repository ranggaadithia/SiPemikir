<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <div class="container">
    <a class="col-md-3 col-lg-2 me-0 px-3 title text-decoration-none text-white fs-3 py-2" href="/dashboard">SiPemikir</a>
    <div class="dropdown">
      <a class="dropdown-toggle text-decoration-none text-dark p-0 m-0" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}" alt="" width="40" height="40" class="rounded-circle overflow-hidden">
      </a>
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
        <li><a class="dropdown-item {{ Request::is('/') ? 'active' : '' }}" href="/"><i class="bi bi-house-door"></i> Home</a></li>
        <li><a class="dropdown-item {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts"><i class="bi bi-layout-text-window-reverse"></i> Dashboard</a></li>
        <li><a class="dropdown-item {{ Request::is('dashboard/users/'. auth()->user()->username .'/edit') ? 'active' : '' }}" href="/dashboard/users/{{ auth()->user()->username }}/edit"><i class="bi bi-person"></i> Profile</a></li>
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
  </div>
</header>