<?php

/**
 * VISTA QUE MUESTA LA LISTA DE TAREAS.
 * El controlador será el que nos proporcine en la variable $tareas
 * que contiene las tareas a mostrar
 */
?>
@extends('_template')

@section('cuerpo')
<h1>Listado de tareas</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <td>Id</td>
            <td>Nombre</td>
            <td>Prioridad</td>
            <td></td>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach($tareas as $tarea)
        <tr>
            <td>{{$tarea['id']}}</td>
            <td>{{$tarea['nombre']}}</td>
            <td>{{$tarea['prioridad']}}</td>
            <td>
                <a class="btn btn-primary" href="<?= BASE_URL ?>edit?id={{$tarea['id']}}">Modificar</a>
                <a class="btn btn-danger" href="<?= BASE_URL ?>del?id={{$tarea['id']}}">Borrar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection