<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>

<body>
    <form action="<?= MODEL_PATH.'form-admin-validacion.php' ?>" method="post">
        <fieldset>
            <legend>Datos persona de contacto:</legend>
            <label for="nif">NIF / CIF:</label>
            <input type="text" name="nif" value="<?= (isset($_POST['nif'])) ? $_POST['nif'] : ""; ?>"> <?=$error->ErrorFormateado('nif');?> <br><br>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?= (isset($_POST['nombre'])) ? $_POST['nombre'] : ""; ?>"> <?=$error->ErrorFormateado('nombre');?> <br><br>
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" value="<?= (isset($_POST['apellidos'])) ? $_POST['apellidos'] : ""; ?>"> <?=$error->ErrorFormateado('apellidos');?> <br><br>
            <label for="telefono">Teléfono:</label>
            <input type="number" name="telefono" value="<?= (isset($_POST['telefono'])) ? $_POST['telefono'] : ""; ?>"> <?=$error->ErrorFormateado('telefono');?> <br><br>
            <label for="correo">Correo electrónico:</label>
            <input type="text" name="correo" value="<?= (isset($_POST['correo'])) ? $_POST['correo'] : ""; ?>"> <?=$error->ErrorFormateado('correo');?> <br><br>
            <label for="poblacion">Población:</label>
            <input type="text" name="poblacion" value="<?= (isset($_POST['poblacion'])) ? $_POST['poblacion'] : ""; ?>"> <?=$error->ErrorFormateado('poblacion');?> <br><br>
            <label for="codpostal">Código postal:</label>
            <input type="text" name="codpostal" value="<?= (isset($_POST['codpostal'])) ? $_POST['codpostal'] : ""; ?>"> <?=$error->ErrorFormateado('poblacion');?> <br><br>
            <label for="provincia">Provincia:</label>
            <select name="provincia" id="">
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
            </select> <?=$error->ErrorFormateado('provincia');?> <br><br>
        </fieldset>
        <br>
        <fieldset>
            <legend>Datos de la tarea</legend>
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="" value="<?= (isset($_POST['direccion'])) ? $_POST['direccion'] : ""; ?>"> <?=$error->ErrorFormateado('direccion');?> <br><br>
            <label for="estado">Estado de la tarea:</label>
            <input type="radio" name="estado" id="" value="B" <?= (isset($_POST['estado'])) && $_POST['estado'] =='B' ? "checked" : ""; ?> > B=Esperando a ser aprobada
            <input type="radio" name="estado" id="" value="P" <?= (isset($_POST['estado'])) && $_POST['estado'] =='P' ? "checked" : ""; ?> > P=Pendiente
            <input type="radio" name="estado" id="" value="R" <?= (isset($_POST['estado'])) && $_POST['estado'] =='R' ? "checked" : ""; ?> > R=Realizada
            <input type="radio" name="estado" id="" value="C" <?= (isset($_POST['estado'])) && $_POST['estado'] =='C' ? "checked" : ""; ?> > C=Cancelada <?=$error->ErrorFormateado('estado');?> <br><br>
            <label for="fechacreacion">Fecha de creación de la tarea:</label>
            <input type="date" name="fechacreacion" id="" readonly> <br><br> 
            <label for="operario">Operario encargado:</label>
            <input type="text" name="operario" id="" value="<?= (isset($_POST['operario'])) ? $_POST['operario'] : ""; ?>"> <?=$error->ErrorFormateado('operario');?> <br><br> 
            <label for="fechatarea">Fecha de realización:</label>
            <input type="date" name="fechatarea" id="" value="<?= (isset($_POST['fechatarea'])) ? $_POST['fechatarea'] : ""; ?>"> <?=$error->ErrorFormateado('fechatarea');?> <br><br> 
            <label for="anotacionanterior">Anotaciones anteriores:</label>
            <input type="text" name="anotacionanterior" id="" value="<?= (isset($_POST['anotacionanterior'])) ? $_POST['anotacionanterior'] : ""; ?>"> <?=$error->ErrorFormateado('anotacionanterior');?> <br><br> 
            <label for="anotacionposterior">Anotaciones posteriores:</label>
            <input type="text" name="anotacionposterior" id="" value="<?= (isset($_POST['anotacionposterior'])) ? $_POST['anotacionposterior'] : ""; ?>"> <?=$error->ErrorFormateado('anotacionposterior');?> <br><br> 
            <textarea name="descripcion" id="" cols="30" rows="10" placeholder="Añada una descripción de la tarea..." value="<?= (isset($_POST['descripcion'])) ? $_POST['descripcion'] : ""; ?>"></textarea> <?=$error->ErrorFormateado('descripcion');?> <br><br>
            <label for="ficheroresumen">Fichero resumen de tareas realizadas:</label>
            <input type="file" name="ficheroresumen" id=""> <br><br> 
            <label for="fotos">Fotos del trabajo realizado:</label>
            <input type="file" name="fotos" id=""> <br><br> 
        </fieldset>
        <input type="submit" name="submit">
    </form>
</body>

</html>