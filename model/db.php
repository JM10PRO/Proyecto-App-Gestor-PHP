<?php

/**
 * Clase de abstracción de ase de datos
 */
class Db
{
	public $pdo = null;
	private static $_instance = null;

	/**
	 * Constructor privado
	 */
	private function __construct()
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$this->pdo = new PDO('mysql:host=localhost;dbname=tareas', 'root', '', $pdo_options);
	}

	/**
	 * Singleton
	 *
	 * @return Db
	 */
	public static function getInstance(): Db
	{

		if (!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function pdo()
	{
		return $this->pdo;
	}

	/**
	 * Genera al vuelo la consulta insert into para los campos que le indicamos
	 * en la tabla indicada
	 *
	 * @param string $tabla
	 * @param array $campos
	 * @return bool
	 */
	public function insert(string $tabla, $campos): bool
	{
		$nombre_campos = implode(',', array_keys($campos)); // => c1, c2,...
		$valores_campos = array_values($campos); // => v1, v2, ..
		$interrogaciones = implode(',', array_map(fn ($v) => '?', $campos));

		$sql = "INSERT INTO $tabla ($nombre_campos) VALUES ($interrogaciones)";

		/*
		// Para depuración
		echo "<pre>SQL: $sql \n Interrogaciones: [$interrogaciones]\nValores \n";
		print_r($valores_campos);
		exit;
		*/

		return $this->pdo
			->prepare($sql)
			->execute($valores_campos);
	}

	/**
	 * Genera al vuelo la consulta insert into para los campos que le indicamos
	 * en la tabla indicada
	 *
	 * @param string $tabla
	 * @param array $campos
	 * @param int $id
	 * @return bool
	 */
	public function update(string $tabla, $campos, $id): bool
	{
		// $nombre_campos = implode(',', array_keys($campos)); // => c1, c2,...
		$valores_campos = array_values($campos); // => v1, v2, ..
		// $interrogaciones = implode(',', array_map(fn ($v) => '?', $campos));

		$sql = "UPDATE $tabla SET ";

		$fin = count($campos);
		$count = 0;
		foreach($campos as $key => $value){
			$count++;
			$sql .= "$key='$value'";
			if($count!=$fin){
				$sql .= ",";
			}
		}

		$sql .= " WHERE id=$id";

		/*
		// Para depuración
		echo "<pre>SQL: $sql \n \nValores \n";
		print_r($valores_campos);
		exit;
		*/

		return $this->pdo
			->prepare($sql)
			->execute();
	}

	/**
	 * Genera al vuelo la consulta insert into para los campos que le indicamos
	 * en la tabla indicada
	 *
	 * @param string $tabla
	 * @param array $campos
	 * @param int $id
	 * @return bool
	 */
	public function delete(string $tabla, $id): bool
	{
		// $nombre_campos = implode(',', array_keys($campos)); // => c1, c2,...
		// $valores_campos = array_values($campos); // => v1, v2, ..
		// $interrogaciones = implode(',', array_map(fn ($v) => '?', $campos));

		$sql = "DELETE FROM $tabla WHERE id=$id";

		/*
		// Para depuración
		echo "<pre>SQL: $sql \n \nValores \n";
		print_r($valores_campos);
		exit;
		*/

		return $this->pdo
			->prepare($sql)
			->execute();
	}


	/**
	 * Devuelve el registro de la tabla indicada cuyo valor es igual que el indicado en $search_value 
	 * en el campo de la tabla $key_field
	 *
	 * @param string $tabla Nombre de la tabla
	 * @param string $search_value Valor a buscar
	 * @param string $key_field	Nombre campo de la tabla
	 * @return array|null
	 */
	public function find(string $tabla, string $search_value, string $key_field = 'id'): ?array
	{
		$sql = "select * from $tabla where $key_field=:key_value limit 1";
		$campos = ['key_value' => $search_value];


		/*
		// Para depuración
		echo "<pre>SQL: $sql \n Valores\n";
		print_r($campos);
		//exit;*/
		$pdo_stm = $this->pdo->prepare($sql);
		$pdo_stm->execute($campos);
		return $pdo_stm->fetch(PDO::FETCH_ASSOC);
	}

	// Aquí irian otras funciones útiles para trabajar con la base de datos

	/**
	 * Devuelve el registro de la tabla indicada cuyo valor es igual que el indicado en $search_value 
	 * en el campo de la tabla $key_field
	 *
	 * @param string $tabla Nombre de la tabla
	 * @param string $search_value Valor a buscar
	 * @param string $key_field	Nombre campo de la tabla
	 * @return array|null
	 */
	public function orderBy(string $tabla, string $search_value): ?array
	{
		$sql = "SELECT * FROM $tabla ORDER BY $search_value DESC";
		/*
		// Para depuración
		echo "<pre>SQL: $sql \n Valores\n";
		print_r($campos);
		//exit;*/
		$pdo_stm = $this->pdo->prepare($sql);
		$pdo_stm->execute();
		return $pdo_stm->fetchAll();
	}

	/**
	 * Devuelve el registro de la tabla indicada cuyo valor es igual que el indicado en $search_value 
	 * en el campo de la tabla $key_field
	 *
	 * @param string $tabla Nombre de la tabla
	 * @param string $search_value Valor a buscar
	 * @param string $key_field	Nombre campo de la tabla
	 * @return array|null
	 */
	public function orderByLimit(string $tabla, string $order_value, int $empezar_desde, int $tamano_paginas): ?array
	{
		$sql = "SELECT * FROM $tabla ORDER BY $order_value DESC LIMIT $empezar_desde,$tamano_paginas";
		/*
		// Para depuración
		echo "<pre>SQL: $sql \n Valores\n";
		print_r($campos);
		//exit;*/
		$pdo_stm = $this->pdo->prepare($sql);
		$pdo_stm->execute();
		return $pdo_stm->fetchAll();
	}

}