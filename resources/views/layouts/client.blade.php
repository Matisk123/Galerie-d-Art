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


    <div class="sidebar text-white">

        <h4>Galerie</h4>

        <ul class="nav flex-column">

            <li class="nav-item mb-2">
                <a class="nav-link" href="/menu">
                    Accueil
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link" href="/oeuvres">
                    Œuvres
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link" href="/peintures">
                    Peinture
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link" href="/artistes">
                    Artistes
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link" href="/expositions">
                    Expositions
                </a>
            </li>

        </ul>


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

                <div class="profile-name">
                    {{ Auth::user()->name }}
                </div>

                <div class="profile-email">
                    {{ Auth::user()->email }}
                </div>

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

            <button class="logout-btn w-100">
                Déconnexion
            </button>

        </form>


        <div class="theme-switch">

            <span>Theme</span>

            <label class="switch">

                <input type="checkbox" id="theme-toggle">

                <span class="slider"></span>

            </label>

        </div>

    </div>


    <div class="content">

        @yield('content')

    </div>


</div>


<script>

    const toggle = document.getElementById("theme-toggle");

    if(localStorage.getItem("theme") === "dark"){
        document.body.classList.add("dark-mode");
        toggle.checked = true;
    }

    toggle.addEventListener("change", function(){

        if(this.checked){
            document.body.classList.add("dark-mode");
            localStorage.setItem("theme","dark");
        }else{
            document.body.classList.remove("dark-mode");
            localStorage.setItem("theme","light");
        }

    });

</script>

<script>

    document.querySelectorAll('.like-btn').forEach(button => {

        button.addEventListener('click', function(e){

            e.preventDefault();

            this.classList.toggle('active');

            const icon = this.querySelector('i');

            if(this.classList.contains('active')){
                icon.classList.remove('bi-heart');
                icon.classList.add('bi-heart-fill');
            }else{
                icon.classList.remove('bi-heart-fill');
                icon.classList.add('bi-heart');
            }

        });

    });

</script>

<script>
    document.addEventListener('click', async function (e) {
        const btn = e.target.closest('.favorite-btn');
        if (!btn) return;

        const oeuvreId = btn.dataset.id;

        const res = await fetch(`/favorites/${oeuvreId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });

        const data = await res.json();

        btn.classList.toggle('active', data.status === 'added');
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.favorite-btn').forEach(button => {

            button.addEventListener('click', async function (e) {
                e.preventDefault();
                e.stopPropagation();

                const oeuvreId = this.dataset.id;
                const buttonElement = this;

                try {
                    const response = await fetch(`/oeuvres/${oeuvreId}/favorite`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        buttonElement.classList.toggle('active');

                        buttonElement.classList.add('animate-like');

                        setTimeout(() => {
                            buttonElement.classList.remove('animate-like');
                        }, 300);
                    }

                } catch (error) {
                    console.error('Erreur favori:', error);
                }
            });

        });

    });
</script>
</body>
</html>
