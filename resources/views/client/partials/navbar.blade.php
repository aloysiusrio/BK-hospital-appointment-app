<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        
    </div>
</div>

<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="#">PearlCare</a></h1>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>                                
                <li>         
                    @if (Auth::check())
                        <a class="nav-link scrollto" href="{{ route('logout') }}">Logout</a>
                    @else                            
                        <a class="nav-link scrollto" href="{{ route('login') }}">Login</a>
                    @endif
                </li> 
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

        <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Register</span>
            Pasien</a>

    </div>
</header>
