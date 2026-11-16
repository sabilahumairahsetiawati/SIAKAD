<nav class="navbar navbar-dark bg-success sticky-top shadow-sm">
    <div class="container-fluid">
        <button class="navbar-toggler d-lg-none" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu"
            aria-controls="sidebarMenu" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand fw-semibold" href="{{ route('dashboard') }}">
            {{ config('app.name', 'SIAKAD') }}
        </a>

        <button type="button" class="btn btn-outline-light btn-sm ms-auto"
            id="themeToggle" aria-label="Ganti tema" aria-pressed="false">
            <i class="bi bi-moon-stars-fill me-1" aria-hidden="true"></i>
            <span id="themeToggleLabel">Tema gelap</span>
        </button>
		
@auth
    <div class="dropdown ms-2">
        <button class="btn btn-primary dropdown-toggle" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
            <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
        </button>

        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <span class="dropdown-item-text small">
                    {{ Auth::user()->email }}
                    <span class="badge text-bg-secondary ms-1">
                        {{ Auth::user()->role }}
                    </span>
                </span>
            </li>

            <li><hr class="dropdown-divider"></li>

            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Keluar
                    </button>
                </form>
            </li>
        </ul>
    </div>
@endauth

    </div>
</nav>

@push('scripts')
    <script>
        (() => {
            const root = document.documentElement;
            const button = document.getElementById('themeToggle');
            const label = document.getElementById('themeToggleLabel');
            const savedTheme = localStorage.getItem('siakad-theme');

            if (savedTheme === 'light' || savedTheme === 'dark') {
                root.setAttribute('data-bs-theme', savedTheme);
            }

            const updateButton = () => {
                const isDark = root.getAttribute('data-bs-theme') === 'dark';
                label.textContent = isDark ? 'Tema terang' : 'Tema gelap';
                button.setAttribute('aria-pressed', String(isDark));
            };

            updateButton();
            button.addEventListener('click', () => {
                const nextTheme = root.getAttribute('data-bs-theme') === 'dark'
                    ? 'light'
                    : 'dark';

                root.setAttribute('data-bs-theme', nextTheme);
                localStorage.setItem('siakad-theme', nextTheme);
                updateButton();
            });
        })();
    </script>
@endpush
