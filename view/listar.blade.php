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
            <td>Apellidos</td>
            <td>Teléfono</td>
            <td>Correo</td>
            <td>Población</td>
            <td>Código postal</td>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach($tareas as $tarea)
        <tr>
            <td>{{$tarea['id']}}</td>
            <td>{{$tarea['nif']}}</td>
            <td>{{$tarea['nombre']}}</td>
            <td>{{$tarea['apellidos']}}</td>
            <td>{{$tarea['telefono']}}</td>
            <td>{{$tarea['correo']}}</td>
            <td>{{$tarea['poblacion']}}</td>
            <td>{{$tarea['codpostal']}}</td>
            <td>{{$tarea['provincia']}}</td>
            <td>{{$tarea['direccion']}}</td>
            <td>{{$tarea['estado']}}</td>
            <td>{{$tarea['fechacreacion']}}</td>
            <td>{{$tarea['operario']}}</td>
            <td>{{$tarea['fechatarea']}}</td>
            <td>{{$tarea['anotacionanterior']}}</td>
            <td>{{$tarea['anotacionposterior']}}</td>
            <td>{{$tarea['descripcion']}}</td>
            <td>{{$tarea['ficheroresumen']}}</td>
            <td>{{$tarea['fotos']}}</td>
            <td>
                <a class="btn btn-primary" href="<?= BASE_URL ?>edit?id={{$tarea['id']}}">Modificar</a>
                <a class="btn btn-danger" href="<?= BASE_URL ?>del?id={{$tarea['id']}}">Borrar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection