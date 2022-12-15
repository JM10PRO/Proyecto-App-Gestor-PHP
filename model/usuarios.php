<?php
include_once(__DIR__ . '/db.php');

class Usuarios_Model
{
    public function __construct()
    {
    }

    /**
     * Devuelve las tareas existentes.
     * Simulamos lectura de base de datos, aunque leemos de sessión
     * @return array
     */
    public function GetUsuarios()
    {
        $pdo = Db::getInstance()->pdo();

        $rs = $pdo->query("SELECT * FROM usuarios");
        return $rs->fetchAll();
    }

    /**
     * Devuelve las tareas existentes.
     * Simulamos lectura de base de datos, aunque leemos de sessión
     * @return array
     */
    public function GetUsuariosOrderByLimitePag($order_value,$empezar_desde,$tamano_paginas)
    {
        return Db::getInstance()->orderByLimitASC('usuarios', $order_value,$empezar_desde,$tamano_paginas);
    }

    /**
     * Devuelve las tareas existentes.
     * Simulamos lectura de base de datos, aunque leemos de sessión
     * @return array
     */
    public function GetTareasWhereOrderByLimitePag($where_key,$where_value,$order_value,$empezar_desde,$tamano_paginas)
    {
        return Db::getInstance()->selectWhereOrderBy('tareas', $where_key, $where_value,$order_value,$empezar_desde,$tamano_paginas);
    }

    /**
     * Devuelve los datos de un usuario
     * @param string $id
     * @return boolean
     */
    public function GetUsuario($id)
    {
        return DB::getInstance()->find('usuarios', $id);
    }
}