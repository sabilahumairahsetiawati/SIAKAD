<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container-fluid">
        <button class="navbar-toggler d-lg-none" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
            aria-controls="sidebarMenu" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand fw-semibold" href="{{ route('dashboard') }}">
            {{ config('app.name', 'SIAKAD') }}
        </a>
    </div>
</nav>