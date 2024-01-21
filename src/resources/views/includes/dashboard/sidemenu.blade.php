<nav class="flex-fill pe-0 font-title d-flex flex-column">

    <ul class="nav my-2">

        @foreach (config('panel.actionlinks') as $link)
            @include('panel::includes.dashboard.sidelink')
        @endforeach

        @foreach (config('panel.modulelinks') as $link)
            {{-- @hasanyrole($link['access']) --}}
                @if (isset($link['module']))
                    <li class="nav-item">
                        <div class="smaller text-uppercase font-title text-white py-2 ps-3">
                            <p class="mb-1 ls-1">{{ $link['module'] }}</p>
                        </div>
                    </li>
                @else
                    @if (count($link['child']))
                        @include('panel::includes.dashboard.sidelinks')
                    @else
                        @include('panel::includes.dashboard.sidelink')
                    @endif
                @endif
            {{-- @endhasanyrole --}}
        @endforeach

    </ul>

</nav>

<style scoped>
    .nav-item .nav-link {
        width: 100% !important;
        cursor: pointer;
    }

    .nav-item .nav-link,
    .nav-item .nav-link:hover,
    .nav-item .nav-link.active {
        border-top-left-radius: 25px !important;
        border-bottom-left-radius: 25px !important;
        border-top-right-radius: 0px !important;
        border-bottom-right-radius: 0px !important;
    }

    .nav-item .nav-link.parent:hover,
    .nav-item .nav-link.parent.active {
        background-color: #ea3941;
    }

    .nav-item .nav-link.child:hover,
    .nav-item .nav-link.child.active {
        background-color: #414141;
    }
</style>