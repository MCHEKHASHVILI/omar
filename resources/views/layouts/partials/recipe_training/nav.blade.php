<nav>
    <div class="navbar">
        <div class="logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="fitBite Logo">
        </div>
        <ul>
            <li>
                <a href="{{ URL(config('constants.RECIPES.ADMIN_RECIPES')); }}">
                    <i class="fas fa-user"></i>
                    <span class="nav-item">{{ Str::upper(config('constants.RECIPES.COLLECTION')) }}</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('/admin/recipes/create'); }}">
                    <i class="fas fa-user"></i>
                    <span class="nav-item">ADD {{ Str::upper(config('constants.RECIPES.COLLECTION')) }}</span>
                </a>
            </li>
            <li>
                <a href="{{ URL(config('constants.TRAININGS.ADMIN_TRAININGS')); }}">
                    <i class="fas fa-chart-bar"></i>
                    <span class="nav-item">{{Str::upper(config('constants.TRAININGS.COLLECTION'))}}</span>
                </a>
            </li>
            <li>
                <a href="{{ URL('/admin/trainings/create'); }}">
                    <i class="fas fa-chart-bar"></i>
                    <span class="nav-item">ADD {{Str::upper(config('constants.TRAININGS.COLLECTION'))}}</span>
                </a>
            </li>
            <li>
                <a href="#" class="logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="nav-item">LOGOUT</span>
                </a>
            </li>
        </ul>
    </div>
</nav>