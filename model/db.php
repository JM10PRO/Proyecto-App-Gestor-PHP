<?php

/**
 * Clase de abstracción de ase de datos
 */
class Db
{
	public $pdo = null;
	private static $_instance = null;
	protected $host = 'localhost';
	protected $db = 'tareas';
	protected $user = 'root';


	/**
	 * Constructor privado
	 */
	private function __construct()
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$this->pdo = new PDO('mysql:host=localhost;dbname=tareasexamen', 'root', '', $pdo_options);
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

	/**
	 * Retorna el objeto PDO creado en el constructor
	 *
	 * @return PDO
	 */
	public function pdo():PDO
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
	public function insert(string $tabla, array $campos): bool
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
	 * Genera al vuelo la consulta update para los campos que le indicamos
	 * en la tabla indicada
	 *
	 * @param string $tabla
	 * @param array $campos
	 * @param int $id
	 * @return bool
	 */
	public function update(string $tabla, array $campos, int $id): bool
	{
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
	public function delete(string $tabla, int $id): bool
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
		$sql = "SELECT * FROM $tabla WHERE $key_field=:key_value LIMIT 1";
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
	 * @param string $order_value Valor por el que ordena los registros devueltos
	 * @return array|null
	 */
	public function orderBy(string $tabla, string $order_value): ?array
	{
		$sql = "SELECT * FROM $tabla ORDER BY $order_value DESC";
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

	/**
	 * Devuelve el registro de la tabla indicada ordenado por el valor indicado en $order_value, por defecto descendiente.
	 *
	 * @param string $tabla Nombre de la tabla
	 * @param string $order_value Columna que indica el orden
	 * @param integer $empezar_desde Primera página a mostrar
	 * @param integer $tamano_paginas Cantidad de registros a mostrar en cada página
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

	/**
	 * Devuelve el registro de la tabla indicada ordenado por el valor indicado en $order_value, por defecto ascendiente.
	 *
	 * @param string $tabla Nombre de la tabla
	 * @param string $order_value Columna que indica el orden
	 * @param integer $empezar_desde Primera página a mostrar
	 * @param integer $tamano_paginas Cantidad de registros a mostrar en cada página
	 * @return array|null
	 */
	public function orderByLimitASC(string $tabla, string $order_value, int $empezar_desde, int $tamano_paginas): ?array
	{
		$sql = "SELECT * FROM $tabla ORDER BY $order_value ASC LIMIT $empezar_desde,$tamano_paginas";
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
	 * Devuelve los registros de la base de datos que coincidan con el valor de la cláusula WHERE y los ordena según el valor de la cláusula ORDER BY.
	 *
	 * @param string $tabla Nombre de la tabla
	 * @param string $where_key Columna de la tabla
	 * @param string $where_value Valor al que se iguala el dato de la columna
	 * @param string $order_value Columna que indica el orden de los registros, por defecto descendiente
	 * @param integer $empezar_desde Número de página por la que empieza la paginación 
	 * @param integer $tamano_paginas Cantidad de páginas en las que se muestran los registros
	 * @return array|null
	 */
	public function selectWhereOrderBy(string $tabla, string $where_key, string $where_value, string $order_value, int $empezar_desde, int $tamano_paginas): ?array
	{
		$sql = "SELECT * FROM $tabla WHERE $where_key='$where_value' ORDER BY $order_value DESC LIMIT $empezar_desde,$tamano_paginas";
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
	 * Devuelve un solo registro si los datos del usuario se encuentran en la base de datos, en caso contrario devuelve null. 
	 *
	 * @param string $user
	 * @param string $pass
	 * @param string $db_user Campo establecido por defecto
	 * @param string $db_pass Campo establecido por defecto
	 * @return array|null
	 */
	public function getUserCredentials(string $user, string $pass, string $db_user = 'usuario', string $db_pass = 'password'): ?array
	{
		$sql = "SELECT * FROM usuarios WHERE $db_user=:usuario AND $db_pass=:passwd LIMIT 1";
		$campos = ['usuario' => $user, 'passwd'=>$pass];

		$pdo_stm = $this->pdo->prepare($sql);
		$pdo_stm->execute($campos);
		return $pdo_stm->fetchAll();
	}

}