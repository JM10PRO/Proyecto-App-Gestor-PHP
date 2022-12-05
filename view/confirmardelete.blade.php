@extends('_template')

@section('cuerpo')

<h3>¿Desea borrar la tarea?</h3>
<a href="<?= BASE_URL ?>del?id={{$tarea['id']}}" class="btn btn-success">Aceptar</a>
<a href="<?= BASE_URL ?>listar" class="btn btn-danger">Cancelar</a>

@endsection