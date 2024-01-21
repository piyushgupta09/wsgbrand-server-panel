<ul class="nav flex-column justify-content-end mb-2 font-title">
    @foreach (config('panel.applinks') as $link)
        @include('panel::includes.dashboard.sidelink')
    @endforeach
</ul>

<ul class="nav flex-column bg-danger "
    style="margin-left: -0.5rem; /* compensating sidebar padding-start: 0.5rem */">

    <li class="nav-item ps-2">
        
        <button 
            class="nav-link btn d-flex align-items-center text-white parent py-2"
            id="dropdownUsermenu" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ Auth::user()->getProfileImage() }}" width="32" height="32" class="nav-icon me-3">
            <span class="d-flex justify-content-between align-items-center flex-fill">
                <span class="text-capitalize fw-500 overflow-hidden max-line-2" style="max-width: 180px">
                    {{ Auth::user()->name }}
                </span>
                <i class="bi bi-chevron-up pt-1"></i>
            </span>
        </button>

        <ul id="userMenuListDropup" style="width: 280px;"
            class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start shadow border-0 rounded-0" 
            aria-labelledby="dropdownUsermenu">

            @foreach (config('panel.userlinks') as $action)
                <li>
                    <a class="dropdown-item fw-500" href="{{ route($action['route']) }}">
                        {{ $action['name'] }}
                    </a>
                </li>
            @endforeach

            <li><hr class="dropdown-divider"></li>

            @foreach (config('panel.defaultinks') as $link)
                <li>
                    <a class="dropdown-item fw-500" href="{{ route($link['route']) }}">
                        {{ $link['name'] }}
                    </a>
                </li>
            @endforeach

            <li><hr class="dropdown-divider"></li>

            <li>
                <h5 class="dropdown-header text-capitalize text-start">
                    last Login: {{ Auth::user()->updated_at->format('h:m:s d M y') }}
                </h5>
            </li>

            <li>
                <form class="form-inline mb-0" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item fw-500" type="submit">Logout</button>
                </form>
            </li>
        </ul>  
    </li>

</ul>

<style scoped>
    body.sidebar-mini.sidebar-collapse .nav-sidebar li .nav-link p {
        display: none;
    }
</style>