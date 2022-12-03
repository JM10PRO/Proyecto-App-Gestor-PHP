<?php
// include 'classGestorErrores.php';

$error = new GestorErrores('<span style="color: #f00900;">', '</span>');

if ($_POST) {
    
    if (empty($_POST['nif'])) {
        $error->AnotaError('nif', "El campo 'NIF / CIF' es obligatorio");
    } elseif (!validateNif($_POST['nif'])) {
        $error->AnotaError('nif', "El NIF o CIF no es válido");
    }

    if (empty($_POST['nombre'])) {
        $error->AnotaError('nombre', "El campo 'Nombre' es obligatorio");
    }

    if (empty($_POST['apellidos'])) {
        $error->AnotaError('apellidos', "El campo 'Apellidos' es obligatorio");
    }
    
    if (empty($_POST['telefono'])) {
        $error->AnotaError('telefono', "El campo 'Teléfono' es obligatorio");
    }elseif(!is_string($_POST['telefono'])){
        $error->AnotaError('telefono', "Compruebe el número de teléfono");
    }
    
    if (empty($_POST['correo'])) {
        $error->AnotaError('correo', "El campo 'Apellidos' es obligatorio");
    } elseif (filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL) == '') {
        $error->AnotaError('correo', "El campo 'Apellidos' es obligatorio");
    }
    
    if (empty($_POST['poblacion'])) {
        $error->AnotaError('poblacion', "El campo 'Poblacion' es obligatorio");
    }

    if (empty($_POST['codpostal'])) {
        $error->AnotaError('codpostal', "El campo 'Código Postal' es obligatorio");
    }
    
    if (empty($_POST['provincia'])) {
        $error->AnotaError('provincia', "Por favor, seleccione una provincia");
    }
    
    if (empty($_POST['direccion'])) {
        $error->AnotaError('direccion', "La dirección es obligatoria");
    }

    if (empty($_POST['estado'])) {
        $error->AnotaError('estado', "El estado de la tarea es obligatorio");
    }elseif($_POST['estado'] != "B" || $_POST['estado'] != "P" || $_POST['estado'] != "R" || $_POST['estado'] != "C"){
        $error->AnotaError('estado', "Por favor, añade el estado de la tarea");
    }

    $_POST['fechacreacion'] = new DateTime();

    if (empty($_POST['operario'])) {
        $error->AnotaError('operario', "El nombre del operario es obligatorio");
    }elseif(!is_string($_POST['operario'])){
        $error->AnotaError('operario', "Por favor, introduce un nombre sin números ni carácteres especiales");
    }

    if ($_POST['fechacreacion'] == '') {
        $error->AnotaError('fechacreacion', "La fecha no está en el formato correcto");
    }
    
    if ($error->HayErrores()) {
        include 'form-admin.php';
    } else {
        include 'form-resu.php';
    }

} else {
    include 'form-admin.php';
}

function validateNif($nif)
{
    $nif_codes = 'TRWAGMYFPDXBNJZSQVHLCKE';

    $sum = (string) getCifSum($nif);
    $n = 10 - substr($sum, -1);

    if (preg_match('/^[0-9]{8}[A-Z]{1}$/', $nif)) {
        // DNIs
        $num = substr($nif, 0, 8);

        return ($nif[8] == $nif_codes[$num % 23]);
    } elseif (preg_match('/^[XYZ][0-9]{7}[A-Z]{1}$/', $nif)) {
        // NIEs normales
        $tmp = substr($nif, 1, 7);
        $tmp = strtr(substr($nif, 0, 1), 'XYZ', '012') . $tmp;

        return ($nif[8] == $nif_codes[$tmp % 23]);
    } elseif (preg_match('/^[KLM]{1}/', $nif)) {
        // NIFs especiales
        return ($nif[8] == chr($n + 64));
    } elseif (preg_match('/^[T]{1}[A-Z0-9]{8}$/', $nif)) {
        // NIE extraño
        return true;
    }

    return false;
}

function getCifSum($cif)
{
    $sum = $cif[2] + $cif[4] + $cif[6];

    for ($i = 1; $i < 8; $i += 2) {
        $tmp = (string) (2 * $cif[$i]);

        $tmp = $tmp[0] + ((strlen($tmp) == 2) ?  $tmp[1] : 0);

        $sum += $tmp;
    }

    return $sum;
}
