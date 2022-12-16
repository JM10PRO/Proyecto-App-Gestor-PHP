<?php
include_once(__DIR__ . '/db.php');

class Tareas_Model
{
    public function __construct()
    {
    }

    /**
     * Devuelve las tareas existentes.
     * @return array
     */
    public function GetTareas(): array
    {
        $pdo = Db::getInstance()->pdo();

        $rs = $pdo->query("SELECT * FROM tareas");
        return $rs->fetchAll();
    }

    /**
     * Devuelve las tareas existentes según cláusula WHERE.
     * @return array
     */
    public function GetTareasWhere(string $where_key, string $where_value): array
    {
        $pdo = Db::getInstance()->pdo();

        $rs = $pdo->query("SELECT * FROM tareas WHERE $where_key='$where_value'");
        return $rs->fetchAll();
    }

    /**
     * Devuelve las tareas existentes ordenadas por el valor que se pasa por parámetro.
     *
     * @param string $order_value
     * @param integer $empezar_desde
     * @param integer $tamano_paginas
     * @return array
     */
    public function GetTareasOrderByLimitePag(string $order_value, int $empezar_desde, int $tamano_paginas): array
    {
        return Db::getInstance()->orderByLimit('tareas', $order_value,$empezar_desde,$tamano_paginas);
    }

    /**
     * Devuelve las tareas existentes ordenadas por un campo y con paginación.
     *
     * @param string $where_key
     * @param string $where_value
     * @param string $order_value
     * @param integer $empezar_desde
     * @param integer $tamano_paginas
     * @return array
     */
    public function GetTareasWhereOrderByLimitePag(string $where_key,string $where_value, string $order_value, int $empezar_desde, int $tamano_paginas): array
    {
        return Db::getInstance()->selectWhereOrderBy('tareas', $where_key, $where_value,$order_value,$empezar_desde,$tamano_paginas);
    }

    /**
     * Devuelve los datos de una tarea
     *
     * @param integer $id
     * @return array|null
     */
    public function GetTarea(int $id): ?array
    {
        return DB::getInstance()->find('tareas', $id);
    }

    /**
     * Añade una nueva tarea a la lista
     * @param array $tarea
     * @return bool
     */
    public function Add(array $campos_tarea): bool
    {
        return Db::getInstance()->insert('tareas', $campos_tarea);
    }

    /**
     * Actualiza los datos almacenados de una tarea
     * @param int $id
     * @param array $tarea
     * @return bool
     */
    public function Update(int $id, array $tarea): bool
    {
        // En construcción
        return Db::getInstance()->update('tareas', $tarea, $id);
    }

    /**
     * Borra la tarea seleccionada
     * @param int $id
     * @return bool
     */
    public function Del($id): bool
    {
        // En construcción
        return DB::getInstance()->delete('tareas', $id);
    }
}
