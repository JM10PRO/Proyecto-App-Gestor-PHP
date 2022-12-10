<div class="container-fluid">
    <ul class="nav nav-pills nav-fill" style="--bs-nav-pills-link-active-bg: #fd610d;">
        <a href="" class="navbar-brand">Bunglebuild S.L</a>
        <li class="nav-item"><a href="<?= BASE_URL ?>operariolistar" class="nav-link active" aria-current="page">Listar tareas</a></li>
        <li class="nav-item"><a href="<?= BASE_URL ?>nuevatarea" class="nav-link active" aria-current="page">Nueva tarea</a></li>
        <li class="nav-item"><a href="<?= BASE_URL ?>logout" class="nav-link active logout" aria-current="page">Cerrar sesión</a></li>
    </ul>
    <div class="userconnected">
    Usuario conectado: <?=$_SESSION['usuario_conectado'];?> <br> Rol: <?=$_SESSION['rol']?>
    </div>
</div>