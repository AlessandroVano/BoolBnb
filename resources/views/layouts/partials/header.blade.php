<header>
    <nav class="navbar navbar-expand-md navbar-dark text-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fab fa-airbnb text-pink h2 icon"></i>

                <a href="{{ url('/') }}" class=" nav-link Boolbnb text-white text-decoration-none vertical-align-center fs-c pl-0 d-none d-sm-block d-dm-block d-lg-block d-xl-block">{{ config('app.name') }}</a>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                  
    
                </ul>
    
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-right" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-right" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link text-right @if(Request::route()->getName() == 'admin.apartments.index') active @endif" 
                            href="{{ route('admin.apartments.index') }}">Views your apartments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-right @if(Request::route()->getName() == 'admin.apartments.create') active @endif" 
                            href="{{ route('admin.apartments.create') }}">Add new apartment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-right @if(Request::route()->getName() == 'admin.home') active @endif" 
                            href="{{ route('admin.home') }}">Your Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-right" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} 
                                {{ Auth::user()->surname}}
                            </a>
    
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.apartments.index') }}">
                                    <i class="fa-solid fa-house-user mr-2"></i> Views your apartments 
                               </a>
                               <a class="dropdown-item" href="{{ route('admin.apartments.create') }}">
                                <i class="fa-solid fa-plus mr-2"></i> Add new apartment 
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.home') }}">
                                    <i class="fa-solid fa-circle-left mr-2"></i> Back to your dashboard 
                               </a>
    
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket mr-2"></i> 
                                    {{ __('Logout') }}
                                </a>
    
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>