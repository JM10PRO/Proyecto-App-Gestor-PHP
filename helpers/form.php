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

if (!function_exists('validateNif')) {

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
}

if (!function_exists('getCifSum')) {

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
}
