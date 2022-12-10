<?php
/**
 * Funciones de ayuda que nos permitirán trabajar con formularios
 * 
 */

if (!function_exists('VPost')) {
    /**
     * Devuelve el valor de una variable enviada por POST. Devolverá el valor
     * por defecto en caso de no existir.
     *
     * @param string $campo
     * @param string $default   Valor por defecto en caso de no existir
     * @return string
     */
    function VPost($campo, $default = '')
    {
        if (isset($_POST[$campo])) {
            return $_POST[$campo];
        } else {
            return $default;
        }
    }
}

if (!function_exists('validarNie')) {
    function validarNie($dni)
    {
        $dnisL = substr($dni, 0, -1);
        $letra = substr($dni, -1);
        $letra = strtoupper($letra);
        $lista = "TRWAGMYFPDXBNJZSQVHLCKE";
        $arLista = str_split($lista);

        if (strlen($dnisL) == 8 && is_numeric($dnisL)) {
            $resultado = (int)$dnisL % 23;
            $letraAsign = $arLista[$resultado];
            if ($letra == $letraAsign) {
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('validar_fecha_espanol')) {
    function validar_fecha_espanol($fecha)
    {
        $valores = explode('-', $fecha);
        if (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])) {
            return true;
        }
        return false;
    }
}

if (!function_exists('validar_fichero_subido')) {
    function validar_fichero_subido($fichero)
    {
        $fichero_subido = ASSETS_PATH . 'uploads/' . basename($fichero['name']);

        if (move_uploaded_file($fichero['tmp_name'], $fichero_subido)) {
            return true;
        } else {
            return false;
        }
    }
}
