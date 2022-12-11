@extends('_template')

@section('cuerpo')

<h1>{{$operacion}}</h1>
<div style="float:left">
    <form enctype="multipart/form-data" method="post">
        <fieldset>
            <legend>Datos persona de contacto:</legend>
            <p>
                <label for="nif">NIF / CIF: {{$tarea['nif']}}</label>
            </p>
            <p>
                <label for="personacontacto">Persona de contacto: {{$tarea['personacontacto']}}</label>
            </p>
            <p>
                <label for="telefono">Teléfono: {{$tarea['telefono']}}</label>
            </p>
            <p>
                <label for="correo">Correo electrónico: {{$tarea['correo']}}</label>
            </p>
            <p>
                <label for="poblacion">Población: {{$tarea['poblacion']}}</label>
            </p>
            <p>
                <label for="codpostal">Código postal: {{$tarea['codpostal']}}</label>
            </p>
            <p>
                <label for="provincia">Provincia: {{$tarea['provincia']}}</label>
            </p>
        </fieldset>
        <br>
        <fieldset>
            <legend>Datos de la tarea</legend>
            <p>
                <label for="direccion">Dirección: {{$tarea['direccion']}}</label>
            </p>
            <p>
                <label for="estado">Estado de la tarea:</label>
                <input type="radio" name="estado" id="" value="B" <?= ($tarea['estado']) == 'B' ? "checked" : ""; ?>> B=Esperando a ser aprobada
                <input type="radio" name="estado" id="" value="P" <?= ($tarea['estado']) == 'P' ? "checked" : ""; ?>> P=Pendiente
                <input type="radio" name="estado" id="" value="R" <?= ($tarea['estado']) == 'R' ? "checked" : ""; ?>> R=Realizada
                <input type="radio" name="estado" id="" value="C" <?= ($tarea['estado']) == 'C' ? "checked" : ""; ?>> C=Cancelada
                <?= $errores->ErrorFormateado('estado'); ?>
            </p>
            <p>
                <label for="fechacreacion">Fecha de creación de la tarea: {{$tarea['fechacreacion']}}</label>
            </p>
            <p>
                <label for="operario">Operario encargado: {{$tarea['operario']}}</label>
            </p>
            <p>
                <label for="fecharealizacion">Fecha de realización: {{$tarea['fecharealizacion']}}</label>
            </p>
            <p>
                <label for="anotacionanterior">Anotaciones anteriores:</label>
                <input type="text" name="anotacionanterior" id="" value="{{$tarea['anotacionanterior']}}">
                <?= $errores->ErrorFormateado('anotacionanterior'); ?>
            </p>
            <p>
                <label for="anotacionposterior">Anotaciones posteriores:</label>
                <input type="text" name="anotacionposterior" id="" value="{{$tarea['anotacionposterior']}}">
                <?= $errores->ErrorFormateado('anotacionposterior'); ?>
            </p>
            <p>
                <label for="descripcion">Descripción de la tarea: </label> <br>
            <p>{{$tarea['descripcion']}}</p>
            </p>
            <p>
                <label for="ficheroresumen">Fichero resumen de tareas realizadas:</label>
                <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                <!-- <input type="hidden" name="MAX_FILE_SIZE" value="30000"> -->
                <input type="file" name="ficheroresumen" id="" value="{{$tarea['ficheroresumen']}}">
                <?= $errores->ErrorFormateado('ficheroresumen'); ?>
            </p>
            <p>
                <label for="fotos">Fotos del trabajo realizado:</label>
                <input type="file" name="fotos" id="" value="{{$tarea['fotos']}}">
                <?= $errores->ErrorFormateado('fotos'); ?>
            </p>
        </fieldset>
        <button type="submit">Enviar</button> <br><br>
    </form>
    <a class="btn btn-secondary" href="<?= BASE_URL ?>operariolistar?pagina={{$pagina}}">Volver al listado</a>
    <br><br>
</div>
@endsection