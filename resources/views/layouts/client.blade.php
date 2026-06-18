<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Galerie d'art</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="sidebar text-white">

        <h4>Galerie</h4>

        <ul class="nav flex-column">

            <li class="nav-item mb-2"><a class="nav-link" href="/menu">Accueil</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="/oeuvres">Œuvres</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="/peintures">Peinture</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="/artistes">Artistes</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="/expositions">Expositions</a></li>

        </ul>

        {{-- PROFILE --}}
        <a href="/profile" class="profile-box text-white text-decoration-none position-relative">

            @if(Auth::user()->profile_photo)
                <img src="{{ asset('storage/'.Auth::user()->profile_photo) }}" class="profile-photo">
            @else
                <img src="https://via.placeholder.com/45" class="profile-photo">
            @endif

            @if(Auth::user()->notifications()->where('read',false)->count() > 0)
                <span class="notif-dot"></span>
            @endif

            <div class="profile-info">

                <div class="profile-name">{{ Auth::user()->name }}</div>
                <div class="profile-email">{{ Auth::user()->email }}</div>

                <div class="profile-role">
                    @if(Auth::user()->hasRole('super_admin'))
                        Super Admin
                    @elseif(Auth::user()->hasRole('admin'))
                        Admin
                    @else
                        Client
                    @endif
                </div>

            </div>

        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn w-100">Déconnexion</button>
        </form>

        {{-- THEME --}}
        <div class="theme-switch">
            <span>Theme</span>
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider"></span>
            </label>
        </div>

    </div>

    {{-- CONTENT --}}
    <div class="content">
        @yield('content')
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const toggle = document.getElementById("theme-toggle");

        if (!toggle) return;

        if (localStorage.getItem("theme") === "dark") {
            document.body.classList.add("dark-mode");
            toggle.checked = true;
        }

        toggle.addEventListener("change", function () {
            if (this.checked) {
                document.body.classList.add("dark-mode");
                localStorage.setItem("theme", "dark");
            } else {
                document.body.classList.remove("dark-mode");
                localStorage.setItem("theme", "light");
            }
        });

    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll('.favorite-btn').forEach(btn => {

            btn.addEventListener('click', async function (e) {
                e.preventDefault();
                e.stopPropagation();

                const oeuvreId = this.dataset.id;

                if (!oeuvreId) return;

                try {
                    const response = await fetch(`/favorites/${oeuvreId}`, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Content-Type": "application/json",
                            "Accept": "application/json"
                        }
                    });

                    const data = await response.json();

                    if (data.status === 'added') {
                        this.classList.add('active');
                        animateHeart(this);
                    }

                    if (data.status === 'removed') {
                        this.classList.remove('active');
                    }

                } catch (error) {
                    console.error("Erreur favori:", error);
                }
            });

        });

        function animateHeart(el) {
            el.classList.add('pop');
            setTimeout(() => el.classList.remove('pop'), 300);
        }

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const categorie = document.getElementById('categorie');
        const styleBox = document.getElementById('style-box');

        if (!categorie || !styleBox) return;

        function toggleStyle() {
            const value = (categorie.value || '').toLowerCase();
            styleBox.style.display = (value === 'peinture') ? 'block' : 'none';
        }

        categorie.addEventListener('change', toggleStyle);
        toggleStyle();

    });
</script>

<script>
    document.getElementById('search-input').addEventListener('keyup', function () {

        let query = this.value;

        if (query.length < 2) {
            document.getElementById('suggestions-box').innerHTML = '';
            return;
        }

        fetch("{{ route('peintures.search.suggestions') }}?search=" + query)
            .then(response => response.json())
            .then(data => {

                let box = document.getElementById('suggestions-box');
                box.innerHTML = '';

                data.forEach(item => {
                    let div = document.createElement('div');

                    div.innerHTML = item;
                    div.style.padding = "8px";
                    div.style.cursor = "pointer";

                    div.onclick = function () {
                        document.getElementById('search-input').value = item;
                        box.innerHTML = '';
                    };

                    box.appendChild(div);
                });

            });

    });
</script>

<script>
    document.getElementById('search-input').addEventListener('keyup', function () {

        let query = this.value;

        if (query.length < 2) {
            document.getElementById('suggestions-box').innerHTML = '';
            return;
        }

        fetch("{{ route('oeuvres.search.suggestions') }}?search=" + query)
            .then(res => res.json())
            .then(data => {

                let box = document.getElementById('suggestions-box');
                box.innerHTML = '';

                data.forEach(item => {
                    let div = document.createElement('div');
                    div.innerHTML = item;
                    div.style.padding = "8px";
                    div.style.cursor = "pointer";

                    div.onclick = function () {
                        document.getElementById('search-input').value = item;
                        box.innerHTML = '';
                    };

                    box.appendChild(div);
                });

            });

    });
</script>
</body>
</html>
