<div class="d-flex align-items-center">
    
    <form class="d-flex me-3" role="search">
        <input class="form-control me-2 search-bar" type="search" placeholder="Search product..." aria-label="Search">
    </form>

    <ul class="navbar-nav ms-auto">
        @guest
            <li class="nav-item">
                <a class="nav-link fw-bold text-white" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item ms-3">
                <a class="nav-link fw-bold text-white" href="{{ route('register') }}">Register</a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="bi bi-person-circle fs-5 me-2"></i> 
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2" aria-labelledby="navbarDropdown">
                    
                    <a class="dropdown-item py-2" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person me-2 text-muted"></i> Profile
                    </a>

                    <a class="dropdown-item py-2" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-2 text-muted"></i> Dashboard
                    </a>
                    
                    <hr class="dropdown-divider">

                    <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
    
    </div>