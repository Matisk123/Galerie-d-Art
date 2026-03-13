<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">
    <title>Galerie d'art</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

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

</body>
</html>
