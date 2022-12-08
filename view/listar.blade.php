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
                <td>NIF</td>
                <td>Persona de contacto</td>
                <td>Estado de la tarea</td>
                <td>Operario</td>
                <td>Fecha de realización</td>
                <td>Descripción</td>
                <td>Opciones</td>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach($tareas as $tarea)
            <tr>
                <td>{{$tarea['id']}}</td>
                <td>{{$tarea['nif']}}</td>
                <td>{{$tarea['personacontacto']}}</td>
                <td>{{$tarea['estado']}}</td>
                <td>{{$tarea['operario']}}</td>
                <td>{{$tarea['fecharealizacion']}}</td>
                <td>{{$tarea['descripcion']}}</td>
                <td>
                    <a class="btn btn-secondary" href="<?= BASE_URL ?>detalles?id={{$tarea['id']}}&pagina={{$pagactual}}">Detalles</a>
                    <a class="btn btn-primary" href="<?= BASE_URL ?>edit?id={{$tarea['id']}}">Modificar</a>
                    <a class="btn btn-danger" href="<?= BASE_URL ?>confirmardelete?id={{$tarea['id']}}">Borrar</a>
                </td>
            </tr>
            @endforeach
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
        @for ($i = 1; $i <= $totalpags; $i++) <li class="page-item"><a class="page-link" href="?pagina={{$i}}">{{$i}}</a></li>
            @endfor
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
    </ul>
</nav>
@endsection