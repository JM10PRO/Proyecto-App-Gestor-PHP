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
    function VPost($campo, $default = ''):string
    {
        if (isset($_POST[$campo])) {
            return $_POST[$campo];
        } else {
            return $default;
        }
    }
}

if (!function_exists('VGet')) {
    /**
     * Devuelve el valor de una variable enviada por POST. Devolverá el valor
     * por defecto en caso de no existir.
     *
     * @param string $campo
     * @param string $default   Valor por defecto en caso de no existir
     * @return string
     */
    function VGet($campo, $default = ''):string
    {
        if (isset($_GET[$campo])) {
            return $_GET[$campo];
        } else {
            return $default;
        }
    }
}

if (!function_exists('validarNie')) {
    /**
     * Valida el DNI o NIF que se pasa por parámetro. Retorna true si es válido y false en caso contrario.
     *
     * @param string $dni
     * @return boolean
     */
    function validarNie($dni):bool
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

if (!function_exists('validarFecha')) {
    /**
     * Valida si el string pasado por parámetro es una fecha válida en el formato dd-mm-aaaa.
     *
     * @param string $fecha
     * @return void
     */
    function validarFecha($fecha)
    {
        $valores = explode('-', $fecha);
        if (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])) {
            return true;
        }
        return false;
    }
}