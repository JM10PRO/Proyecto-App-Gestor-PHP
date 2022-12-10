<div class="container-fluid">
    <ul class="nav nav-pills nav-fill" style="--bs-nav-pills-link-active-bg: #fd610d;">
        <a href="" class="navbar-brand">Bunglebuild S.L</a>
        <li class="nav-item"><a href="<?= BASE_URL ?>operariolistar" class="nav-link active" aria-current="page">Listar tareas</a></li>
        <li class="nav-item"><a href="<?= BASE_URL ?>nuevatarea" class="nav-link active" aria-current="page">Nueva tarea</a></li>
        <!-- <li class="nav-item"><a href="{{ BASE_URL }}" class="nav-link active" aria-current="page">Inicio</a></li>
        <li class="nav-item"><a href="<?= BASE_URL ?>add" class="nav-link active" aria-current="page">Alta</a></li> -->
        <li class="nav-item"><a href="<?= BASE_URL ?>logout" class="nav-link active logout" aria-current="page">Logout</a></li>
        <li class="nav-item"><a href="<?= BASE_URL ?>logout" class="nav-link active logout" aria-current="page">Usuario: <?=$_SESSION['usuario_conectado'];?> </a></li>
    </ul>
</div>