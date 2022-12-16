<?php

/**
 * VISTA QUE MUESTA LA LISTA DE TAREAS.
 * El controlador será el que nos proporcine en la variable $tareas
 * que contiene las tareas a mostrar
 */
?>
@extends('_template')

@section('cuerpo')
<h1>{{$operacion}}</h1>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre usuario</td>
                <td>Contraseña</td>
                <td>Rol</td>
                <td>Opciones</td>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{$usuario['id']}}</td>
                <td>{{$usuario['usuario']}}</td>
                <td>{{$usuario['password']}}</td>
                <td>{{$usuario['rol']}}</td>
                <td>
                    <!-- <a class="btn btn-secondary" href="<?= BASE_URL ?>detalles?id={{$tarea['id']}}&pagina={{$pagactual}}">Detalles</a> -->
                    <a class="btn btn-primary" href="<?= BASE_URL ?>editarusuario?id={{$usuario['id']}}&pagina={{$pagactual}}">Modificar</a>
                    <a class="btn btn-danger" href="<?= BASE_URL ?>confirmardeleteusuario?id={{$usuario['id']}}&pagina={{$pagactual}}">Borrar</a>
                </td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <form method="get">
                    <td><input type="text" name="usuario" id="" value="<?= (isset($_GET['usuario'])) ? $_GET['usuario'] : ""; ?>"></td>
                    <td><input type="text" name="password" id="" value="<?= (isset($_GET['password'])) ? $_GET['password'] : ""; ?>"></td>
                    <td><input type="text" name="rol" id="" value="<?= (isset($_GET['rol'])) ? $_GET['rol'] : ""; ?>"></td>
                    <td>
                        <input type="hidden" name="adduser" value="true">
                        <button class="btn btn-success" type="submit">Añadir</button>
                    </td>
                </form>
            </tr>
            <tr>
                <td></td>
                <td><?= $errores->ErrorFormateado('usuario'); ?></td>
                <td><?= $errores->ErrorFormateado('password'); ?></td>
                <td><?= $errores->ErrorFormateado('rol'); ?></td>
            </tr>
        </tbody>
    </table>
</div>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-left">
        <!-- Ir a la primera página -->
        <li class="page-item">
            <a class="page-link" href="?pagina=1"> Primera página </a>
        </li>
        <!-- Ir a la página anterior -->
        @if($pagactual == 1)
        <li class="page-item disabled">
            <a class="page-link" href="?pagina={{$pagactual-1}}">
                << </a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="?pagina={{$pagactual-1}}">
                << </a>
        </li>
        @endif
        <!-- Páginas disponibles -->
        @if($pagactual < $totalpags && $pagactual <=$totalpags - 3) @for ($i=$pagactual; $i <=$pagactual + 3; $i++) <li class="page-item">
            <a class="page-link" href="?pagina={{$i}}">{{$i}}</a>
            </li>
            @endfor
            @else
            @for ($i = $pagactual; $i <= $totalpags; $i++) <li class="page-item">
                <a class="page-link" href="?pagina={{$i}}">{{$i}}</a>
                </li>
                @endfor
                @endif
                <!-- Ir a la página siguiente -->
                @if($pagactual == $totalpags)
                <li class="page-item disabled">
                    <a class="page-link" href="?pagina={{$pagactual+1}}"> >> </a>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="?pagina={{$pagactual+1}}"> >> </a>
                </li>
                @endif
                <!-- Ir a la última página -->
                <li class="page-item">
                    <a class="page-link" href="?pagina={{$totalpags}}"> Última página </a>
                </li>
                <!-- Navegar a la página seleccionada -->
                <form method="get">
                    <button type="submit" class="page-link irpag" style="margin-left: 35px;">Ir a la página</button>
                    <select name="pagina" id="" style="margin-left: 10px; padding: 6px; padding-bottom: 7px;">
                        @for ($i = 1; $i <= $totalpags; $i++) <option value="{{$i}}" @if(isset($_GET['pagina']) && $_GET['pagina']==$i) selected @endif>{{$i}}</option>
                            @endfor
                    </select>
                </form>
    </ul>
</nav>
@endsection