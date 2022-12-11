<?php

/**
 * VISTA QUE MUESTA LA LISTA DE TAREAS.
 * El controlador será el que nos proporcine en la variable $tareas
 * que contiene las tareas a mostrar
 */
?>
@extends('_template')

@section('cuerpo')
<h1>Detalles de la tarea</h1>
<div class="table-responsive">
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
                <td>Operario</td>
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
                <td>{{$tarea['fecharealizacion']}}</td>
                <td>{{$tarea['anotacionanterior']}}</td>
                <td>{{$tarea['anotacionposterior']}}</td>
                <td>{{$tarea['descripcion']}}</td>
                <td><a href="\appPHP\assets\uploads\{{$tarea['ficheroresumen']}}" target="_blank">{{$tarea['ficheroresumen']}}</a></td>
                <td><a href="\appPHP\assets\uploads\{{$tarea['fotos']}}" target="_blank">{{$tarea['fotos']}}</a></td>
                <td>
                <a class="btn btn-success" href="<?= BASE_URL ?>completartarea?id={{$tarea['id']}}&pagina={{$pagina}}">Completar</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<a class="btn btn-secondary" href="<?= BASE_URL ?>operariolistar?pagina={{$pagina}}">Volver al listado</a>
@endsection