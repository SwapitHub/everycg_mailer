<nav class="navbar">
    <div class="navbar-content">

        <div class="logo-mini-wrapper">
            <img src="{{ asset('theme') }}/images/logo-mini-light.png" class="logo-mini logo-mini-light" alt="logo">
            <img src="{{ asset('theme') }}/images/logo-mini-dark.png" class="logo-mini logo-mini-dark" alt="logo">
        </div>
        <ul class="navbar-nav">
            <li class="theme-switcher-wrapper nav-item">
                <input type="checkbox" value="" id="theme-switcher">
                <label for="theme-switcher">
                    <div class="box">
                        <div class="ball"></div>
                        <div class="icons">
                            <i data-lucide="sun"></i>
                            <i data-lucide="moon"></i>
                        </div>
                    </div>
                </label>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{-- <img class="w-30px h-30px ms-1 rounded-circle" src="{{ asset('theme') }}/images/faces/face1.jpg"
                        alt="profile"> --}}
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="w-30px h-30px ms-1 rounded-circle" src="{{ Auth::user()->profile_photo_url }}"
                            alt="profile">
                    @else
                        <img class="w-30px h-30px ms-1 rounded-circle" src="{{ Auth::user()->profile_photo_url }}"
                            alt="profile">
                    @endif
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">

                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="w-80px h-80px rounded-circle"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="profile">
                            @else
                                <img class="w-80px h-80px rounded-circle"
                                src="{{ asset('theme') }}/images/faces/face1.jpg" alt="">
                            @endif
                        </div>
                        <div class="text-center">
                            <p class="fs-16px fw-bolder">{{ Auth::user()->name }}</p>
                            <p class="fs-12px text-secondary">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li>
                            <a href="{{ route('profile.show') }}" class="dropdown-item py-2 text-body ms-0">
                                <i class="me-2 icon-md" data-lucide="user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" x-data id="logout-form">
                                @csrf
                                <a href="javascript:void(0)"
                                    onclick="document.getElementById('logout-form').submit();"
                                    class="dropdown-item py-2 text-body ms-0">
                                    <i class="me-2 icon-md" data-lucide="log-out"></i>
                                    <span>Log Out</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <a href="#" class="sidebar-toggler">
            <i data-lucide="menu"></i>
        </a>

    </div>
</nav>
