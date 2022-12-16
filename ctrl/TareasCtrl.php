<?php

use Jenssegers\Blade\Blade;

include(HELPERS_PATH . 'GestorErrores.php');
include(HELPERS_PATH . 'form.php');
include(MODEL_PATH . 'tareas.php');
/**
 * TareasCtrl es la clase manejadora de los eventos relacionados con las tareas
 *
 * @author José María Gil Leal
 * Fecha de creación 3 diciembre 2022
 * versión 2.0
 */
class TareasCtrl
{
    protected $model = null;
    protected $errores = null;
    protected $blade = null;

    /**
     * El constructor de la clase TareasCtrl crea un objeto de la clase Tareas_Model del modelo. Además, crea un objeto de la clase GestorErrores de la carpeta "helpers". Por último, crea un objeto de la clase Blade que viene en el paquete de Jenssegers\Blade y es el encargado de renderizar las vistas.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = new Tareas_Model();

        // El gestor solo sería necesario crearlo si editamos o insertamos
        // Inicializamos el gestor de errores que utilizaremos en la vista
        $this->errores = new GestorErrores(
            '<span style="color:red; background:#EEE; padding:.2em 1em; margin:1em">',
            '</span>'
        );

        $this->blade = new Blade(VIEW_PATH, CACHE_PATH);
    }

    /**
     * Devuelve un objeto de tipo TareasCtrl
     * @return TareasCtrl
     */
    public static function getInstance():TareasCtrl
    {
        return new self();
    }

    // ==========================
    // ====FUNCIONES DE ADMIN====
    // ==========================

    /**
     * Muestra la lista de tareas. Guarda la página que estaba visitando para volver a esa página concreta y no al principio. Por defecto, mostrará la primera página.
     * @return string
     */
    public function Listar():string
    {
        $tamano_paginas = 5;
        if (isset($_GET['pagina'])) {
            if ($_GET['pagina'] == 1) {
                Session::redirect('/listar');
            } else {
                $pagina = $_GET['pagina'];
            }
        } else {
            $pagina = 1;
        }
        $empezar_desde = ($pagina - 1) * $tamano_paginas;
        $num_filas = $this->model->GetTareas();
        $num_filas = count($num_filas);
        $total_paginas = ceil($num_filas / $tamano_paginas);
        $tareas = $this->model->GetTareasOrderByLimitePag('fecharealizacion', $empezar_desde, $tamano_paginas);

        return $this->blade->render('listar', array(
            'operacion' => 'Listado de tareas - Página ' . $pagina . " de " . $total_paginas,
            'tareas' => $tareas,
            'pagactual' => $pagina,
            'totalpags' => $total_paginas
        ));
    }

    /**
     * Muestra el formulario para registrar una nueva tarea
     * @return string
     */
    public function NuevaTarea():string
    {
        if (!$_POST) {
            // Primera vez.
            $tarea = array(
                'nif' =>  '',
                'personacontacto' => '',
                'telefono' => '',
                'correo' => '',
                'poblacion' => '',
                'codpostal' => '',
                'provincia' => '',
                'direccion' => '',
                'estado' => '',
                'fechacreacion' => '',
                'operario' => '',
                'fecharealizacion' => '',
                'anotacionanterior' => '',
                'anotacionposterior' => '',
                'descripcion' => '',
                'ficheroresumen' => '',
                'fotos' => ''
            );
        } else {
            // Filtrar datos
            $this->FiltraCamposPost();

            // Creamos el objeto tarea que es el que se utiliza en el formulario
            //- Lo creamos a partir de los datos recibidos del POST
            $tarea = array(
                'nif' =>  VPost('nif'),
                'personacontacto' => VPost('personacontacto'),
                'telefono' => VPost('telefono'),
                'correo' => VPost('correo'),
                'poblacion' => VPost('poblacion'),
                'codpostal' => VPost('codpostal'),
                'provincia' => VPost('provincia'),
                'direccion' => VPost('direccion'),
                'estado' => VPost('estado'),
                'fechacreacion' => VPost('fechacreacion'),
                'operario' => VPost('operario'),
                'fechacreacion' => VPost('fechacreacion'),
                'anotacionanterior' => VPost('anotacionanterior'),
                'anotacionposterior' => VPost('anotacionposterior'),
                'descripcion' => VPost('descripcion'),
                'ficheroresumen' => VPost('ficheroresumen'),
                'fotos' => VPost('fotos')
            );

            if (!$this->errores->HayErrores()) {
                // Guardamos la tarea y finalizamos
                $this->model->Add($tarea);
                Session::redirect('/listar');
            }
        }
        // Mostramos los datos
        return $this->blade->render('nuevatarea', array(
            'operacion' => 'Registrar nueva tarea',
            'tarea' => $tarea,
            'errores' => $this->errores
        ));
        // // En un controlador real esto haría más cosas
        // return $this->blade->render('nuevatarea');
    }

    /**
     * Muestra la lista de tareas pendientes. También guarda la página que estaba visitando cuando entre en alguna de las opciones, para volver a esa página concreta y no al principio. Por defecto, mostrará la primera página.
     * @return string
     */
    public function ListarTareasPendientes():string
    {
        $tamano_paginas = 5;
        if (isset($_GET['pagina'])) {
            if ($_GET['pagina'] == 1) {
                Session::redirect('/listartareaspendientes');
            } else {
                $pagina = $_GET['pagina'];
            }
        } else {
            $pagina = 1;
        }
        
        $empezar_desde = ($pagina - 1) * $tamano_paginas;
        $tareas_p = $this->model->GetTareasWhere('estado','P');
        $num_filas = count($tareas_p);
        $total_paginas = ceil($num_filas / $tamano_paginas);
        $tareas = $this->model->GetTareasWhereOrderByLimitePag('estado','P','fecharealizacion',$empezar_desde, $tamano_paginas);

        return $this->blade->render('listar', array(
            'operacion' => 'Listado de tareas pendientes - Página ' . $pagina . " de " . $total_paginas,
            'tareas' => $tareas,
            'pagactual' => $pagina,
            'totalpags' => $total_paginas
        ));
    }

    /**
     * Muestra los detalles de la tarea seleccionada. Captura el id para mostrar toda la información solo la tarea selecionada. También guarda la página que estaba visitando para volver a esa página concreta y no al principio.
     *
     * @return string
     */
    public function DetallesTarea():string
    {
        if (!isset($_GET['id'])) {
            // No existe la tarea, error
            return $this->blade->render('edit_error', [
                'descripcion_error' => 'No existe la tarea seleccionada'
            ]);
        }

        // Han indicado el id
        $id = $_GET['id'];

        $tarea = $this->model->GetTarea($id);

        // Se guarda la página que estábamos visitando en el listado para volver a la misma y no al principio 
        if (isset($_GET['pagina'])) {

            $pagina = $_GET['pagina'];
        } else {
            $pagina = 1;
        }

        return $this->blade->render('detallestarea', array(
            'tarea' => $tarea,
            'pagina' => $pagina
        ));
    }

    /**
     * Permite modificar los datos de la tarea seleccionada. También guarda la página que estaba visitando para volver a esa página concreta y no al principio.
     *
     * @return string
     */
    public function Edit():string
    {
        if (!isset($_GET['id'])) {
            // No existe la tarea, error
            return $this->blade->render('edit_error', [
                'descripcion_error' => 'No existe la tarea seleccionada'
            ]);
        }

        // Han indicado el id
        $id = $_GET['id'];

        // Se guarda la página que estábamos visitando en el listado para volver a la misma y no al principio 
        if (isset($_GET['pagina'])) {

            $pagina = $_GET['pagina'];
        } else {
            $pagina = 1;
        }


        if (!$_POST) {
            // Primera vez.
            // Leo el regitro y muestro los datos
            $tarea = $this->model->GetTarea($id);
            if (!$tarea) {
                // No existe la tarea, error
                return $this->blade->render('edit_error', [
                    'descripcion_error' => 'No existe la tarea seleccionada.'
                ]);
            } else {
                // Mostramos los datos
                return $this->blade->render('edit', [
                    'operacion' => 'Modificar tarea',
                    'tarea' => $tarea,
                    'pagina' => $pagina,
                    'errores' => $this->errores
                ]);
            }
        } else {
            // Filtrar datos
            $this->FiltraCamposPost();

            // Creamos el objeto tarea que es el que se utiliza en el formulario
            // Lo creamos a partir de los datos recibidos del POST
            $tarea = array(
                'nif' =>  VPost('nif'),
                'personacontacto' => VPost('personacontacto'),
                'telefono' => VPost('telefono'),
                'correo' => VPost('correo'),
                'poblacion' => VPost('poblacion'),
                'codpostal' => VPost('codpostal'),
                'provincia' => VPost('provincia'),
                'direccion' => VPost('direccion'),
                'estado' => VPost('estado'),
                'fechacreacion' => VPost('fechacreacion'),
                'operario' => VPost('operario'),
                'fecharealizacion' => VPost('fecharealizacion'),
                'anotacionanterior' => VPost('anotacionanterior'),
                'anotacionposterior' => VPost('anotacionposterior'),
                'descripcion' => VPost('descripcion'),
                'ficheroresumen' => VPost('ficheroresumen'),
                'fotos' => VPost('fotos'),
            );

            if ($this->errores->HayErrores()) {
                // Mostrar ventana de nuevo
                return $this->blade->render('edit', array(
                    'operacion' => 'Modificar tarea',
                    'tarea' => $tarea,
                    'pagina' => $pagina,
                    'errores' => $this->errores
                ));
            } else {
                // Guardamos la tarea
                $this->model->Update($id, $tarea);
                return $this->blade->render('msg', array(
                    'descripcion' => "Se ha guardado la tarea",
                    'pagina' => $pagina
                ));
            }
        }
    }

    /**
     * Muestra la página de confirmación al eliminar una tarea. También guarda la página que estaba visitando cuando pulse el botón de "Cancelar", para volver a esa página concreta y no al principio.
     * @return string
     */
    public function ConfirmarDelete(): string
    {
        if (isset($_GET['id'])) {
            // Han indicado el id
            $id = $_GET['id'];
        }

        $tarea = $this->model->GetTarea($id);

        // Se guarda la página que estábamos visitando en el listado para volver a la misma y no al principio 
        if (isset($_GET['pagina'])) {

            $pagina = $_GET['pagina'];
        } else {
            $pagina = 1;
        }

        return $this->blade->render('confirmardeleteusuario', array(
            'tarea' => $tarea,
            'pagina' => $pagina
        ));
    }

    /**
     * Borra la tarea seleccionada después de confirmar la operación. Redirige al listado de tareas.
     * @return string
     */
    public function Del():string
    {
        try {
            if (isset($_GET['id'])) {
                // Han indicado el id
                $id = $_GET['id'];
                // Si no existe el id se lanza excepción
                $this->model->Del($id);
                // Notificamos el borrado de la tarea, mostrando la lista
                return $this->Listar();
            } else {
                return $this->blade->render('msg', [
                    'descripcion' => 'No se ha indicado la tarea a borrar'
                ]);
            }
        } catch (Exception $ex) {
            return $this->blade->render('msg', [
                'descripcion' => 'No existe la tarea seleccionada para borrar.'
            ]);
        }
    }

    // =============================
    // ====FUNCIONES DE OPERARIO====
    // =============================

    /**
     * Muestra la lista de tareas en la vista del operario. También guarda la página que estaba visitando para volver a esa página concreta y no al principio. Por defecto, mostrará la primera página.
     *
     * @return string
     */
    public function operarioListar():string
    {
        $tamano_paginas = 5;
        if (isset($_GET['pagina'])) {
            if ($_GET['pagina'] == 1) {
                Session::redirect('/operariolistar');
            } else {
                $pagina = $_GET['pagina'];
            }
        } else {
            $pagina = 1;
        }
        $empezar_desde = ($pagina - 1) * $tamano_paginas;
        $num_filas = $this->model->GetTareas();
        $num_filas = count($num_filas);
        $total_paginas = ceil($num_filas / $tamano_paginas);
        $tareas = $this->model->GetTareasOrderByLimitePag('fecharealizacion', $empezar_desde, $tamano_paginas);

        return $this->blade->render('operariolistar', array(
            'operacion' => 'Listado de tareas - Página ' . $pagina . " de " . $total_paginas,
            'tareas' => $tareas,
            'pagactual' => $pagina,
            'totalpags' => $total_paginas
        ));
    }

    /**
     * Muestra la lista de tareas pendientes en la vista del operario. También guarda la página que estaba visitando cuando entre en alguna de las opciones, para volver a esa página concreta y no al principio. Por defecto, mostrará la primera página.
     *
     * @return string
     */
    public function operarioListarTareasPendientes():string
    {
        $tamano_paginas = 5;
        if (isset($_GET['pagina'])) {
            if ($_GET['pagina'] == 1) {
                Session::redirect('/operariolistartareaspendientes');
            } else {
                $pagina = $_GET['pagina'];
            }
        } else {
            $pagina = 1;
        }
        $empezar_desde = ($pagina - 1) * $tamano_paginas;
        $tareas_p = $this->model->GetTareasWhere('estado','P');
        $num_filas = count($tareas_p);
        $total_paginas = ceil($num_filas / $tamano_paginas);
        $tareas = $this->model->GetTareasWhereOrderByLimitePag('estado','P','fecharealizacion',$empezar_desde, $tamano_paginas);
        
        return $this->blade->render('operariolistar', array(
            'operacion' => 'Listado de tareas pendientes - Página ' . $pagina . " de " . $total_paginas,
            'tareas' => $tareas,
            'pagactual' => $pagina,
            'totalpags' => $total_paginas
        ));
    }

    /**
     * Muestra los detalles de la tarea seleccionada. Captura el id de latarea a mostrar y la página que estaba visualizando, para volver a esa página concreta y no al principio.
     *
     * @return string
     */
    public function DetallesTareaOperario():string
    {
        if (!isset($_GET['id'])) {
            // No existe la tarea, error
            return $this->blade->render('edit_error', [
                'descripcion_error' => 'No existe la tarea seleccionada'
            ]);
        }

        // Han indicado el id
        $id = $_GET['id'];

        $tarea = $this->model->GetTarea($id);

        // Se guarda la página que estábamos visitando en el listado para volver a la misma y no al principio 
        if (isset($_GET['pagina'])) {

            $pagina = $_GET['pagina'];
        } else {
            $pagina = 1;
        }

        return $this->blade->render('operariodetallestarea', array(
            'tarea' => $tarea,
            'pagina' => $pagina
        ));
    }

    /**
     * Permite al operario completar una tarea seleccionada (solo se permite modificar algunos datos). También guarda la página que estaba visitando cuando entre en alguna de las opciones, para volver a esa página concreta y no al principio.
     *
     * @return string
     */
    public function completarTarea():string
    {
        if (!isset($_GET['id'])) {
            // No existe la tarea, error
            return $this->blade->render('edit_error', [
                'descripcion_error' => 'No existe la tarea seleccionada'
            ]);
        }

        // Han indicado el id
        $id = $_GET['id'];

        // Se guarda la página que estábamos visitando en el listado para volver a la misma y no al principio 
        if (isset($_GET['pagina'])) {

            $pagina = $_GET['pagina'];
        } else {
            $pagina = 1;
        }


        if (!$_POST) {
            // Primera vez.
            // Leo el regitro y muestro los datos
            $tarea = $this->model->GetTarea($id);
            if (!$tarea) {
                // No existe la tarea, error
                return $this->blade->render('edit_error', [
                    'descripcion_error' => 'No existe la tarea seleccionada.'
                ]);
            } else {
                // Mostramos los datos
                return $this->blade->render('completartarea', [
                    'operacion' => 'Completar tarea',
                    'tarea' => $tarea,
                    'pagina' => $pagina,
                    'errores' => $this->errores
                ]);
            }
        } else {
            // Filtrar datos
            $this->FiltraCamposPostCompletarTarea($id);

            // Creamos el objeto tarea que es el que se utiliza en el formulario
            // Lo creamos a partir de los datos recibidos del POST y de los datos de la tarea que estaban guardados, porque solo modificamos algunos
            $tarea_db = $this->model->GetTarea($id);
            if (!$tarea_db) {
                // No existe la tarea, error
                return $this->blade->render('edit_error', [
                    'descripcion_error' => 'No existe la tarea seleccionada.'
                ]);
            } else {
                $tarea = array(
                    'nif' =>  $tarea_db['nif'],
                    'personacontacto' => $tarea_db['personacontacto'],
                    'telefono' => $tarea_db['telefono'],
                    'correo' => $tarea_db['correo'],
                    'poblacion' => $tarea_db['poblacion'],
                    'codpostal' => $tarea_db['codpostal'],
                    'provincia' => $tarea_db['provincia'],
                    'direccion' => $tarea_db['direccion'],
                    'estado' => $tarea_db['estado'],
                    'fechacreacion' => $tarea_db['fechacreacion'],
                    'operario' => $tarea_db['operario'],
                    'fecharealizacion' => $tarea_db['fecharealizacion'],
                    'anotacionanterior' => VPost('anotacionanterior'),
                    'anotacionposterior' => VPost('anotacionposterior'),
                    'descripcion' => VPost('descripcion'),
                    'ficheroresumen' => $_FILES['ficheroresumen']['name'],
                    'fotos' => $_FILES['fotos']['name']
                );
            }

            if ($this->errores->HayErrores()) {
                // Mostrar ventana de nuevo
                return $this->blade->render('completartarea', array(
                    'operacion' => 'Completar tarea',
                    'tarea' => $tarea,
                    'pagina' => $pagina,
                    'errores' => $this->errores
                ));
            } else {
                // Guardamos la tarea
                $this->model->Update($id, $tarea);
                return $this->blade->render('operariomsg', array(
                    'descripcion' => "Se ha guardado la tarea",
                    'pagina' => $pagina
                ));
            }
        }
    }

    /**
     * Realiza el filtrado de campos y almacena los errores en el gestor de errores
     * @return void
     */
    public function FiltraCamposPost():void
    {
        // Filtramos el nif
        if (VPost('nif') == '') {
            $this->errores->AnotaError('nif', 'El campo NIF es obligatorio');
        } elseif (strlen(VPost('nif')) < 9 || strlen(VPost('nif')) > 9) {
            $this->errores->AnotaError('nif', 'El NIF debe tener 8 dígitos y una letra');
        } elseif (!validarNie(VPost('nif'))) {
            $this->errores->AnotaError('nif', 'El NIF no es correcto');
        }

        // Filtramos el nombre de la persona de contacto
        if (VPost('personacontacto') == '') {
            $this->errores->AnotaError('personacontacto', 'Se debe introducir el nombre');
        }

        // Filtramos el telefono
        if (VPost('telefono') == '') {
            $this->errores->AnotaError('telefono', 'Se debe introducir un teléfono (intrduzca todos los números juntos)');
        } elseif (!is_string($_POST['telefono'])) {
            $this->errores->AnotaError('telefono', "Compruebe el número de teléfono (intrduzca todos los números juntos)");
        } elseif (strlen(VPost('telefono')) < 9) {
            $this->errores->AnotaError('telefono', 'El teléfono debe tener 9 digitos');
        }

        // Filtramos el correo
        if (VPost('correo') == '') {
            $this->errores->AnotaError('correo', 'El correo es obligatorio');
        } elseif (filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL) == '') {
            $this->errores->AnotaError('correo', "El correo no es válido");
        }

        // Filtramos la población
        if (VPost('poblacion') == '') {
            $this->errores->AnotaError('poblacion', 'Debe indicar la población');
        }

        // Filtramos el código postal
        if (VPost('codpostal') == '') {
            $this->errores->AnotaError('codpostal', 'Se debe introducir el código postal');
        } elseif (strlen(VPost('codpostal')) != 5) {
            $this->errores->AnotaError('codpostal', 'El código postal debe tener 5 números');
        }

        // Filtramos la provincia
        if (VPost('provincia') == '') {
            $this->errores->AnotaError('provincia', 'Se debe indicar la provincia');
        }

        // Filtramos la dirección
        if (VPost('direccion') == '') {
            $this->errores->AnotaError('direccion', 'Se debe introducir texto');
        }

        // Filtramos el estado de la tarea
        if (VPost('estado') == '') {
            $this->errores->AnotaError('estado', 'Se debe seleccionar una de las opciones');
        } elseif (VPost('estado') != "B" && VPost('estado') != "P" && VPost('estado') != "R" && VPost('estado') != "C") {
            $this->errores->AnotaError('estado', "Por favor, indica el estado de la tarea");
        }

        // Filtramos y definimos la fecha de creación de la tarea
        $_POST['fechacreacion'] = date("d-m-Y");
        if (VPost('fechacreacion') == '') {
            $this->errores->AnotaError('fechacreacion', 'Se debe introducir una fecha');
        }

        // Filtramos el operario
        if (VPost('operario') == '') {
            $this->errores->AnotaError('operario', 'Se debe indicar el operario');
        } elseif (is_numeric(VPost('operario'))) {
            $this->errores->AnotaError('operario', "Por favor, introduce un nombre sin números ni carácteres especiales");
        } elseif (strlen(VPost('operario')) < 3) {
            $this->errores->AnotaError('operario', "Por favor, introduce el nombre");
        }

        $validarFechaRealizacion = validarFecha(VPost('fecharealizacion'));

        if (VPost('fecharealizacion') == '') {
            $this->errores->AnotaError('fecharealizacion', 'Se debe introducir una fecha');
        } elseif (!$validarFechaRealizacion) {
            $this->errores->AnotaError('fecharealizacion', 'Introduzca una fecha válida');
        } elseif (VPost('fecharealizacion') < date("Y-m-d")) {
            $this->errores->AnotaError('fecharealizacion', 'La fecha de realizacíon debe ser posterior a hoy');
        }
    }

    /**
     * Filtra los campos de la vista de completar tarea del operario. Captura el id de la tarea de la que se modifican o añaden datos para el nombre de los ficheros adjuntos.  
     *
     * @param int $id
     * @return void
     */
    public function FiltraCamposPostCompletarTarea($id):void
    {
        // Filtramos el estado de la tarea
        if (VPost('estado') == '') {
            $this->errores->AnotaError('estado', 'Se debe seleccionar una de las opciones');
        } elseif (VPost('estado') != "B" && VPost('estado') != "P" && VPost('estado') != "R" && VPost('estado') != "C") {
            $this->errores->AnotaError('estado', "Por favor, indica el estado de la tarea");
        }

        // Filtramos la anotación anterior
        if (VPost('anotacionanterior') == '') {
            $this->errores->AnotaError('anotacionanterior', 'Se debe introducir texto');
        }

        // Filtramos la anotación posterior
        if (VPost('anotacionposterior') == '') {
            $this->errores->AnotaError('anotacionposterior', 'Se debe introducir texto');
        }

        //Filtramos el fichero subido
        $this->validarFichero($_FILES['ficheroresumen'],$id,'ficheroresumen');
        // if(!$this->validarFichero($_FILES['ficheroresumen'],$id,'ficheroresumen')){
        //     $this->errores->AnotaError('ficheroresumen','Error al cargar el archivo');
        // }
        
        //Filtramos el fichero subido
        $this->validarFichero($_FILES['fotos'],$id,'fotos');
        // if(!$this->validarFichero($_FILES['fotos'],$id,'fotos')){
        //     $this->errores->AnotaError('fotos','Error al cargar el archivo');
        // }
    }

    /**
     * Valida el fichero que subimos en el input file de HTML. Si retorna true, el archivo se ha subido a la carpeta indicada. Si retorna false, existe algún problema en la carga del archivo. También almacena los errores en el GestorErrores si está inicializado en la clase a la que pertenece la función.
     *
     * @param array $nombreFichero - debes indicar la variable  $_FILES['nombre_archivo'] donde 'nombre_archivo' es el atributo "name" del input file en el formulario HTML.
     * @param integer $id - identificador de la tarea que predecerá al nombre del archivo
     * @param string $campo - nombre del campo en el input file de HTML
     * @return boolean
     */
    public function validarFichero(array $nombreFichero, int $id, string $campo): bool
    {
        if($nombreFichero['error'] == 0){

            $dir = ASSETS_PATH . "uploads/";
            $tamano_max = 30000; //kb
            $ext_permitidas = array('doc','docx','odt','pdf','jpg','jpeg','png');
            $ruta_carga = $dir . $id ."_". $nombreFichero['name'];
            $arr_archivo = explode(".", $nombreFichero['name']);
            $extension = strtolower(end($arr_archivo));
            
            if(in_array($extension,$ext_permitidas)){
                if($nombreFichero['size'] < $tamano_max * 1024){
                    if(!file_exists($dir)){
                        mkdir($dir, 0777);
                    }
                    if(move_uploaded_file($nombreFichero['tmp_name'], $ruta_carga)){
                        return true; // se ha subido correctamente
                    }else{
                        return false; // error al cargar el archivo
                    }
                }else{
                    $this->errores->AnotaError($campo,'El archivo excede el tamaño permitido');
                    return false;
                }
            }else{
                $this->errores->AnotaError($campo,'Archivo no permitido');
                return false;
            }

        }elseif($nombreFichero['error'] == 4){
            $this->errores->AnotaError($campo,'No has subido archivo');
            return false;
        }else {
            $this->errores->AnotaError($campo,'Error en la subida del archivo');
            return false;
        }
    }
}