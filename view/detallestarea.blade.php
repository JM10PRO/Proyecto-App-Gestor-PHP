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
            <td>NIF</td>
            <td>Persona de contacto</td>
            <td>Teléfono</td>
            <td>Correo</td>
            <td>Población</td>
            <td>Código postal</td>
            <td>Provincia</td>
            <td>Dirección</td>
            <td>Estado</td>
            <td>Fecha de creación</td>
            <td>Fecha de operario</td>
            <td>Fecha de realización</td>
            <td>Anotación anterior</td>
            <td>Anotación posterior</td>
            <td>Descripción</td>
            <td>Fichero resumen</td>
            <td>Fotos</td>
            <td>Opciones</td>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <tr>
            <td>{{$tarea['id']}}</td>
            <td>{{$tarea['nif']}}</td>
            <td>{{$tarea['personacontacto']}}</td>
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
                <a class="btn btn-danger" href="<?= BASE_URL ?>confirmardelete?id={{$tarea['id']}}">Borrar</a>
            </td>
        </tr>
    </tbody>
</table>
<br>
<a class="btn btn-secondary" href="<?= BASE_URL ?>listar">Volver al listado</a>
@endsection