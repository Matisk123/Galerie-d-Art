<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Administration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="d-flex">

    <div class="bg-primary text-white p-3 vh-100" style="width:250px">

        <h4 class="mb-4">Admin</h4>

        <ul class="nav flex-column">

            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="#">
                    Ajouter une œuvre
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="#">
                    Gestion des œuvres
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="#">
                    Statistiques des œuvres
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="#">
                    Gestion des expositions
                </a>
            </li>

            <li class="nav-item mb-2">
                <a class="nav-link text-white" href="#">
                    Page contact
                </a>
            </li>

            <li class="nav-item mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link text-white p-0 border-0 bg-transparent w-100 text-start">
                        Déconnexion
                    </button>
                </form>
            </li>

        </ul>

    </div>

    <div class="flex-grow-1 p-4">

        @yield('content')

    </div>

</div>

</body>
</html>
