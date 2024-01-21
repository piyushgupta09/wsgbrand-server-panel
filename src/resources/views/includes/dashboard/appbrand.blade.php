<nav class="navbar p-0 bg-light border">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between w-100">
            <a class="navbar-brand d-flex align-items-center py-0" href="/">
                <img src="{{ asset('storage/assets/logo.png') }}" alt="Bootstrap" width="52" height="52">
                <span class="flex-fill px-2 fw-500 font-  " style="line-height: 1">
                    {{ config('brand.name') }}
                </span>
                <div class="smaller">{{ config('brand.version') }}</div>
            </a>
            <button type="button" class="d-inline-block d-md-none btn border-0" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
</nav>