<?php
include_once(__DIR__ . '/db.php');

class Tareas_Model
{
    public function __construct()
    {
    }

    /**
     * Devuelve las tareas existentes.
     * Simulamos lectura de base de datos, aunque leemos de sessión
     * @return array
     */
    public function GetTareas()
    {
        $pdo = Db::getInstance()->pdo();

        $rs = $pdo->query("select * from tareas");
        return $rs->fetchAll();
    }

    /**
     * Devuelve las tareas existentes.
     * Simulamos lectura de base de datos, aunque leemos de sessión
     * @return array
     */
    public function GetTareasOrderByLimitePag($order_value,$empezar_desde,$tamano_paginas)
    {
        return Db::getInstance()->orderByLimit('tareas', $order_value,$empezar_desde,$tamano_paginas);
    }

    /**
     * Devuelve los datos de una tarea
     * @param string $id
     * @return boolean
     */
    public function GetTarea($id)
    {
        return DB::getInstance()->find('tareas', $id);
    }

    /**
     * Actualiza los datos almacenados de una tarea
     * @param int $id
     * @param array $tarea
     */
    public function Update($id, $tarea)
    {
        // En construcción
        return Db::getInstance()->update('tareas', $tarea, $id);
    }

    /**
     * Añade una nueva tarea a la lista
     * @param array $tarea
     */
    public function Add($campos_tarea)
    {
        return Db::getInstance()->insert('tareas', $campos_tarea);
    }

    /**
     * Borra la tarea seleccionada
     * @param int $id
     */
    public function Del($id)
    {
        // En construcción
        return DB::getInstance()->delete('tareas', $id);
    }
}
