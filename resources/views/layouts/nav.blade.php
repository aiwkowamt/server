@vite(['resources/sass/app.scss', 'resources/js/app.js'])

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 position-fixed vh-100 bg-dark bg-gradient p-2">
            <div class="dropdown">
                <a class="btn btn-light w-100 dropdown-toggle" href="#" role="button" id="dashboardDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dashboards
                </a>
                <div class="dropdown-menu w-100" aria-labelledby="dashboardDropdown">
                    <a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
                    <a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
                    <a class="dropdown-item" href="{{ route('restaurants.index') }}">Restaurants</a>
                    <a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a>
                </div>
            </div>

            <a class="btn btn-light w-100 mt-2" href="{{ route('declarations.index') }}">Declarations</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100 mt-2">Logout</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 offset-md-2 p-4">
            @yield('content')
        </div>
    </div>
</div>
