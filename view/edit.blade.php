@extends('_template')

@section('cuerpo')

<h1>{{$operacion}}</h1>
<div style="float:left; background-color: #0da4a0;">
    <form enctype="multipart/form-data" method="post">
        <fieldset>
            <legend>Datos persona de contacto:</legend>
            <p>
                <label for="nif">NIF / CIF:</label>
                <input type="text" name="nif" value="{{$tarea['nif']}}"> <?= $errores->ErrorFormateado('nif'); ?>
            </p>
            <p>
                <label for="personacontacto">Persona de contacto:</label>
                <input type="text" name="personacontacto" value="{{$tarea['personacontacto']}}"> <?= $errores->ErrorFormateado('personacontacto'); ?>
            </p>
            <p>
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" value="{{$tarea['telefono']}}"> <?= $errores->ErrorFormateado('telefono'); ?>
            </p>
            <p>
                <label for="correo">Correo electrónico:</label>
                <input type="text" name="correo" value="{{$tarea['correo']}}"> <?= $errores->ErrorFormateado('correo'); ?>
            </p>
            <p>
                <label for="poblacion">Población:</label>
                <input type="text" name="poblacion" value="{{$tarea['poblacion']}}"> <?= $errores->ErrorFormateado('poblacion'); ?>
            </p>
            <p>
                <label for="codpostal">Código postal:</label>
                <input type="text" name="codpostal" value="{{$tarea['codpostal']}}"> <?= $errores->ErrorFormateado('poblacion'); ?>
            </p>
            <p>
                <label for="provincia">Provincia:</label>
                <select name="provincia" id="">
                    <option codigo="" value="{{$tarea['provincia']}}">{{$tarea['provincia']}}</option>
                    <option codigo="" value="">Seleccionar provincia</option>
                    <option codigo="02" value="Albacete">Albacete</option>
                    <option codigo="03" value="Alicante">Alicante</option>
                    <option codigo="05" value="Almería">Almería</option>
                    <option codigo="01" value="Álava">Álava</option>
                    <option codigo="33" value="Asturias">Asturias</option>
                    <option codigo="05" value="Ávila">Ávila</option>
                    <option codigo="06" value="Badajoz">Badajoz</option>
                    <option codigo="07" value="Balears, Illes">Balears, Illes</option>
                    <option codigo="08" value="Barcelona">Barcelona</option>
                    <option codigo="48" value="Bizkaia">Bizkaia</option>
                    <option codigo="09" value="Burgos">Burgos</option>
                    <option codigo="10" value="Cáceres">Cáceres</option>
                    <option codigo="11" value="Cádiz">Cádiz</option>
                    <option codigo="39" value="Cantabria">Cantabria</option>
                    <option codigo="12" value="Castellón">Castellón</option>
                    <option codigo="13" value="Ciudad Real">Ciudad Real</option>
                    <option codigo="14" value="Córdoba">Córdoba</option>
                    <option codigo="15" value="Coruña, A">Coruña, A</option>
                    <option codigo="16" value="Cuenca">Cuenca</option>
                    <option codigo="20" value="Gipuzkoa">Gipuzkoa</option>
                    <option codigo="17" value="Girona">Girona</option>
                    <option codigo="18" value="Granada">Granada</option>
                    <option codigo="19" value="Guadalajara">Guadalajara</option>
                    <option codigo="21" value="Huelva">Huelva</option>
                    <option codigo="22" value="Huesca">Huesca</option>
                    <option codigo="23" value="Jaén">Jaén</option>
                    <option codigo="24" value="León">León</option>
                    <option codigo="25" value="Lleida">Lleida</option>
                    <option codigo="27" value="Lugo">Lugo</option>
                    <option codigo="28" value="Madrid">Madrid</option>
                    <option codigo="29" value="Málaga">Málaga</option>
                    <option codigo="30" value="Murcia">Murcia</option>
                    <option codigo="31" value="Navarra">Navarra</option>
                    <option codigo="32" value="Ourense">Ourense</option>
                    <option codigo="34" value="Palencia">Palencia</option>
                    <option codigo="35" value="Palmas, Las">Palmas, Las</option>
                    <option codigo="36" value="Pontevedra">Pontevedra</option>
                    <option codigo="26" value="Rioja, La">Rioja, La</option>
                    <option codigo="37" value="Salamanca">Salamanca</option>
                    <option codigo="38" value="Santa Cruz de Tenerife">Santa Cruz de Tenerife</option>
                    <option codigo="40" value="Segovia">Segovia</option>
                    <option codigo="41" value="Sevilla">Sevilla</option>
                    <option codigo="42" value="Soria">Soria</option>
                    <option codigo="43" value="Tarragona">Tarragona</option>
                    <option codigo="44" value="Teruel">Teruel</option>
                    <option codigo="45" value="Toledo">Toledo</option>
                    <option codigo="46" value="Valencia">Valencia</option>
                    <option codigo="47" value="Valladolid">Valladolid</option>
                    <option codigo="49" value="Zamora">Zamora</option>
                    <option codigo="50" value="Zaragoza">Zaragoza</option>
                    <option codigo="51" value="Ceuta">Ceuta</option>
                    <option codigo="52" value="Melilla">Melilla</option>
                </select>
                <?= $errores->ErrorFormateado('provincia'); ?>
            </p>
        </fieldset>
        <br>
        <fieldset>
            <legend>Datos de la tarea</legend>
            <p>
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="" value="{{$tarea['direccion']}}">
                <?= $errores->ErrorFormateado('direccion'); ?>
            </p>
            <p>
                <label for="estado">Estado de la tarea:</label>
                <input type="radio" name="estado" id="" value="B" <?= ($tarea['estado']) == 'B' ? "checked" : ""; ?> > B=Esperando a ser aprobada
                <input type="radio" name="estado" id="" value="P" <?= ($tarea['estado']) == 'P' ? "checked" : ""; ?> > P=Pendiente
                <input type="radio" name="estado" id="" value="R" <?= ($tarea['estado']) == 'R' ? "checked" : ""; ?> > R=Realizada
                <input type="radio" name="estado" id="" value="C" <?= ($tarea['estado']) == 'C' ? "checked" : ""; ?> > C=Cancelada
                <?= $errores->ErrorFormateado('estado'); ?>
            </p>
            <p>
                <label for="fechacreacion">Fecha de creación de la tarea:</label>
                <input type="text" name="fechacreacion" id="" readonly value="{{$tarea['fechacreacion']}}">
            </p>
            <p>
                <label for="operario">Operario encargado:</label>
                <input type="text" name="operario" id="" value="{{$tarea['operario']}}"> <?= $errores->ErrorFormateado('operario'); ?>
            </p>
            <p>
                <label for="fecharealizacion">Fecha de realización:</label>
                <input type="date" name="fecharealizacion" id="" value="{{$tarea['fecharealizacion']}}">
                <?= $errores->ErrorFormateado('fecharealizacion'); ?>
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
                <textarea name="descripcion" id="" cols="30" rows="10" placeholder="Añada una descripción de la tarea...">{{$tarea['descripcion']}}</textarea> 
                <?= $errores->ErrorFormateado('descripcion'); ?>
            </p>
            <p>
                <label for="ficheroresumen">Fichero resumen de tareas realizadas:</label>
                <input type="file" name="ficheroresumen" id="" value="{{$tarea['ficheroresumen']}}">
            </p>
            <p>
                <label for="fotos">Fotos del trabajo realizado:</label>
                <input type="file" name="fotos" id="" value="{{$tarea['fotos']}}">
            </p>
        </fieldset>
        <button type="submit">Enviar</button> <br><br>
    </form>
    <a class="btn btn-secondary" href="<?= BASE_URL ?>listar?pagina={{$pagina}}">Volver al listado</a>
    <br><br>
</div>
@endsection