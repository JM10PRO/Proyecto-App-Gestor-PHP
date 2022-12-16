@extends('operario_template')

@section('cuerpo')

<h1>{{$operacion}}</h1>
<div style="float:left; background-color: #0da4f0;">
    <form method="post">
        <fieldset>
            <legend>Modificando mis datos:</legend>
            <p>
                <label for="usuario">Nombre de usuario:</label>
                <input type="text" name="usuario" value="{{$usuario['usuario']}}"> <?= $errores->ErrorFormateado('usuario'); ?>
            </p>
            <p>
                <label for="password">Contraseña:</label>
                <input type="text" name="password" value="{{$usuario['password']}}"> <?= $errores->ErrorFormateado('password'); ?>
            </p>
        </fieldset>
        <button type="submit">Enviar</button> <br><br>
    </form>
    <a class="btn btn-secondary" href="<?= BASE_URL ?>operariolistar?pagina={{$pagina}}">Volver al listado</a>
    <br><br>
</div>
@endsection