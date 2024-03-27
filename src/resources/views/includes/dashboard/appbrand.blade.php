<nav class="navbar bg-light">
    <div class="mx-2 w-100">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('panel.welcome') }}">
            <img src="{{ asset('storage/assets/logo.png') }}" alt="Bootstrap" width="50" style="scale: 1.2">
            <span class="flex-fill ps-3 font-text lh-1">
                <div class="d-flex align-items-center">
                    <span class="fw-bold font-quick fs-4 flex-fill">{{ config('brand.name') }}</span>
                    <span class="small text-muted">{{ config('brand.version') }}</span>
                </div>
                <span class="small text-muted">{{ config('brand.tagline') }}</span>
            </span>
      </a>
    </div>
</nav>