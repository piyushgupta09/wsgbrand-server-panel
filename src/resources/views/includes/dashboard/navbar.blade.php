<nav class="navbar bg-body-tertiary border border-start-0">
    <div class="container-fluid">
        <div class="d-flex justify-content-between w-100">
    
            <div class="d-flex align-items-center me-auto">
    
                <button 
                    type="button" 
                    class="d-inline-block d-md-none btn border-0 py-0" 
                    data-bs-toggle="offcanvas" 
                    data-bs-target="#sideMenuCanvas" 
                    aria-controls="sideMenuCanvas">
                    <i class="bi bi-list fs-4"></i>
                </button>
    
                <a class="btn border-0 text-capitalize fw-bold" href="{{ url()->current() }}">
                    @stack('page-title')
                </a>
    
                <nav class="btn text-start px-0 border-0 font-quick" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        @stack('page-breadcrumb')
                    </ol>
                </nav>
    
            </div>
    
            <div class="d-flex align-items-center ms-auto pe-2">
                @include('panel::includes.dashboard.fullscreen')
                <livewire:notifications />
            </div>
    
        </div>
    </div>
</nav>
