<?php
include_once(__DIR__ . '/db.php');

class Usuarios_Model
{
    public function __construct()
    {
    }

    /**
     * Devuelve los usuarios.
     * @return array
     */
    public function GetUsuarios()
    {
        $pdo = Db::getInstance()->pdo();

        $rs = $pdo->query("SELECT * FROM usuarios");
        return $rs->fetchAll();
    }

    /**
     * Devuelve los usuarios con paginación
     *
     * @param string $order_value
     * @param integer $empezar_desde
     * @param integer $tamano_paginas
     * @return void
     */
    public function GetUsuariosOrderByLimitePag(string $order_value,int $empezar_desde,int $tamano_paginas)
    {
        return Db::getInstance()->orderByLimitASC('usuarios', $order_value,$empezar_desde,$tamano_paginas);
    }

    /**
     * Devuelve los datos de un usuario
     * @param int $id
     * @return boolean
     */
    public function GetUsuario(int $id)
    {
        return DB::getInstance()->find('usuarios', $id);
    }

    /**
     * Añade un nuevo usuario a la base de datos
     * @param array $tarea
     * @return bool
     */
    public function Add(array $campos_usuario): bool
    {
        return Db::getInstance()->insert('usuarios', $campos_usuario);
    }

    /**
     * Actualiza los datos almacenados de un usuario
     * @param int $id
     * @param array $usuario
     * @return bool
     */
    public function Update(int $id, array $usuario): bool
    {
        return Db::getInstance()->update('usuarios', $usuario, $id);
    }

    /**
     * Borra el usuario seleccionado
     * @param int $id
     * @return bool
     */
    public function Del(int $id): bool
    {
        return DB::getInstance()->delete('usuarios', $id);
    }
}