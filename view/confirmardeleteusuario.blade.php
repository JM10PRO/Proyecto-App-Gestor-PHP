@extends('_template')

@section('cuerpo')

<h3>¿Está seguro de borrar este usuario?</h3>
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre usuario</td>
                <td>Contraseña</td>
                <td>Rol</td>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <td>{{$usuario['id']}}</td>
                <td>{{$usuario['usuario']}}</td>
                <td>{{$usuario['password']}}</td>
                <td>{{$usuario['rol']}}</td>
            </tr>
        </tbody>
    </table>
</div>
<br>
<a href="<?= BASE_URL ?>delusuario?id={{$usuario['id']}}" class="btn btn-danger">Borrar</a>
<a href="<?= BASE_URL ?>listarusuarios?pagina={{$pagina}}" class="btn btn-secondary">Cancelar</a>
<br>
@endsection