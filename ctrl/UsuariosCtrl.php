<?php

use Jenssegers\Blade\Blade;

include(HELPERS_PATH . 'GestorErrores.php');
include(HELPERS_PATH . 'form.php');
include(MODEL_PATH . 'usuarios.php');
/**
 * TareasCtrl es la clase manejadora de los eventos relacionados con las tareas
 *
 * @author José María Gil Leal
 * Fecha de creación 3 diciembre 2022
 * versión 2.0
 */
class UsuariosCtrl
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
        $this->model = new Usuarios_Model();

        // El gestor solo sería necesario crearlo si editamos o insertamos
        // Inicializamos el gestor de errores que utilizaremos en la vista
        $this->errores = new GestorErrores(
            '<span style="color:red; background:#EEE; padding:.2em 1em; margin:1em">',
            '</span>'
        );

        $this->blade = new Blade(VIEW_PATH, CACHE_PATH);
    }

    /**
     * Devuelve un objeto de tipo UsuariosCtrl
     * @return UsuariosCtrl
     */
    public static function getInstance(): UsuariosCtrl
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
    public function ListarUsuarios(): string
    {
        if (isset($_GET['adduser'])) {
            $this->FiltraCamposGetUsuario();
            // Creamos el objeto tarea que es el que se utiliza en el formulario
            // Lo creamos a partir de los datos recibidos del GET
            $usuario = array(
                'usuario' =>  VGet('usuario'),
                'password' => VGet('password'),
                'rol' => VGet('rol')
            );

            if (!$this->errores->HayErrores()) {
                // Guardamos el usuario
                $this->model->Add($usuario);
                Session::redirect('/listarusuarios');
            }
        }

        $tamano_paginas = 5;
        if (isset($_GET['pagina'])) {
            if ($_GET['pagina'] == 1) {
                Session::redirect('/listarusuarios');
            } else {
                $pagina = $_GET['pagina'];
            }
        } else {
            $pagina = 1;
        }
        $empezar_desde = ($pagina - 1) * $tamano_paginas;
        $usuarios = $this->model->GetUsuarios();
        $num_filas = count($usuarios);
        $total_paginas = ceil($num_filas / $tamano_paginas);
        $usuarios = $this->model->GetUsuariosOrderByLimitePag('id', $empezar_desde, $tamano_paginas);

        return $this->blade->render('listarusuarios', array(
            'operacion' => 'Listado de usuarios - Página ' . $pagina . " de " . $total_paginas,
            'usuarios' => $usuarios,
            'pagactual' => $pagina,
            'totalpags' => $total_paginas,
            'errores' => $this->errores,
        ));
    }

    /**
     * Permite modificar los datos del usuario seleccionada. También guarda la página que estaba visitando para volver a esa página concreta y no al principio.
     *
     * @return string
     */
    public function EditarUsuario(): string
    {
        if (!isset($_GET['id'])) {
            // No existe la tarea, error
            return $this->blade->render('edit_error', [
                'descripcion_error' => 'No existe el usuario seleccionado'
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
            $usuario = $this->model->GetUsuario($id);
            if (!$usuario) {
                // No existe la usuario, error
                return $this->blade->render('edit_error', [
                    'descripcion_error' => 'No existe el usuario seleccionada.'
                ]);
            } else {
                // Mostramos los datos
                return $this->blade->render('editarusuario', [
                    'operacion' => 'Edición de usuario',
                    'usuario' => $usuario,
                    'pagina' => $pagina,
                    'errores' => $this->errores
                ]);
            }
        } else {
            // Filtrar datos
            $this->FiltraCamposPostUsuario();
            // Creamos el objeto tarea que es el que se utiliza en el formulario
            // Lo creamos a partir de los datos recibidos del POST
            $usuario = array(
                'usuario' =>  VPost('usuario'),
                'password' => VPost('password'),
                'rol' => VPost('rol')
            );

            if (!$this->errores->HayErrores()) {
                // Guardamos el usuario
                $this->model->Update($id, $usuario);
                return $this->blade->render('msgusuario', array(
                    'descripcion' => "Se ha guardado el usuario",
                    'pagina' => $pagina,
                    'color' => '#47cc4b'
                ));
            }
        }
        // Mostrar ventana de nuevo
        return $this->blade->render('editarusuario', array(
            'operacion' => 'Edición de usuario',
            'usuario' => $usuario,
            'pagina' => $pagina,
            'errores' => $this->errores
        ));
    }

    /**
     * Muestra la página de confirmación al eliminar una tarea. También guarda la página que estaba visitando cuando pulse el botón de "Cancelar", para volver a esa página concreta y no al principio.
     * @return string
     */
    public function ConfirmarDelete(): string
    {
        // Se guarda la página que estábamos visitando en el listado para volver a la misma y no al principio 
        if (isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
        } else {
            $pagina = 1;
        }

        if (isset($_GET['id'])) {
            // Han indicado el id
            $id = $_GET['id'];
        }

        $usuario = $this->model->GetUsuario($id);

        $usuarioActual = Session::getUserData($_SESSION['usuario_conectado'], $_SESSION['usuario_conectado_pass']);

        $id_usuario = $usuarioActual[0]['id'];

        if ($id == $id_usuario) {
            return $this->blade->render('msgusuario', [
                'descripcion' => 'No se puede borrar a sí mismo',
                'pagina' => $pagina,
                'color' => '#de1c1c'
            ]);
        }

        return $this->blade->render('confirmardeleteusuario', array(
            'usuario' => $usuario,
            'pagina' => $pagina
        ));
    }

    /**
     * Borra la tarea seleccionada después de confirmar la operación. Redirige al listado de tareas.
     * @return string
     */
    public function Del(): string
    {
        try {
            if (isset($_GET['id'])) {
                // Han indicado el id
                $id = $_GET['id'];
                // Si no existe el id se lanza excepción
                $this->model->Del($id);
                // Notificamos el borrado de la tarea, mostrando la lista
                return $this->ListarUsuarios();
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
     * Permite a un operario modificar sus datos. También guarda la página que estaba visitando para volver a esa página concreta y no al principio.
     *
     * @return string
     */
    public function EditarDatosOperario(): string
    {
        $usuarioActual = Session::getUserData($_SESSION['usuario_conectado'], $_SESSION['usuario_conectado_pass']);

        $id = $usuarioActual[0]['id'];
        $rol = $usuarioActual[0]['rol'];
        $usuario = $this->model->GetUsuario($id);
        // Se guarda la página que estábamos visitando en el listado para volver a la misma y no al principio 
        if (isset($_GET['pagina'])) {

            $pagina = $_GET['pagina'];
        } else {
            $pagina = 1;
        }

        if (!$_POST) {
            // Primera vez.
            // Leo el regitro y muestro los datos

            if (!$usuario) {
                // No existe la usuario, error
                return $this->blade->render('edit_error', [
                    'descripcion_error' => 'No existe el usuario seleccionado.'
                ]);
            } else {
                // Mostramos los datos
                return $this->blade->render('operarioeditdata', [
                    'operacion' => 'Modificar mis datos',
                    'usuario' => $usuario,
                    'pagina' => $pagina,
                    'errores' => $this->errores
                ]);
            }
        } else {
            // Filtrar datos
            $this->FiltraCamposPostUsuario();
            // Creamos el objeto tarea que es el que se utiliza en el formulario
            // Lo creamos a partir de los datos recibidos del POST
            $usuario = array(
                'usuario' =>  VPost('usuario'),
                'password' => VPost('password'),
                'rol' => $rol
            );

            if (!$this->errores->HayErrores()) {
                // Guardamos el usuario
                $this->model->Update($id, $usuario);
                return $this->blade->render('msgoperario', array(
                    'descripcion' => "Se han guardado los datos",
                    'pagina' => $pagina
                ));
            }
        }
        // Mostrar ventana de nuevo
        return $this->blade->render('operarioeditdata', array(
            'operacion' => 'Modificar mis datos',
            'usuario' => $usuario,
            'pagina' => $pagina,
            'errores' => $this->errores
        ));
    }


    /**
     * Realiza el filtrado de campos y almacena los errores en el gestor de errores
     * @return void
     */
    public function FiltraCamposPostUsuario(): void
    {
        // Filtramos el nombre del usuario
        if (VPost('usuario') == '') {
            $this->errores->AnotaError('usuario', 'Se debe introducir el nombre');
        }
        // Filtramos el nombre del usuario
        if (VPost('password') == '') {
            $this->errores->AnotaError('password', 'Se debe introducir una contraseña');
        }
        // Filtramos el nombre del usuario
        if (isset($_POST['rol']) && VPost('rol') == '') {
            $this->errores->AnotaError('rol', 'Se debe introducir el rol');
        }
    }

    /**
     * Realiza el filtrado de campos y almacena los errores en el gestor de errores
     * @return void
     */
    public function FiltraCamposGetUsuario(): void
    {
        // Filtramos el nombre del usuario
        if (VGet('usuario') == '') {
            $this->errores->AnotaError('usuario', 'Se debe introducir el nombre');
        } elseif (strlen(VGet('usuario')) < 3) {
            $this->errores->AnotaError('usuario', 'El nombre de usuario debe tener 3 o más carácteres');
        }
        // Filtramos el nombre del usuario
        if (VGet('password') == '') {
            $this->errores->AnotaError('password', 'Se debe introducir una contraseña');
        }
        // Filtramos el nombre del usuario
        if (VGet('rol') == '') {
            $this->errores->AnotaError('rol', 'Se debe introducir el rol');
        } elseif (VGet('rol') != 'admin' && VGet('rol') != 'operario') {
            $this->errores->AnotaError('rol', 'El Rol solo puede ser admin u operario');
        }
    }

    /**
     * Filtra los campos de la vista de completar tarea del operario. Captura el id de la tarea de la que se modifican o añaden datos para el nombre de los ficheros adjuntos.  
     *
     * @param int $id
     * @return void
     */
    public function FiltraCamposPostCompletarTarea($id): void
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
        $this->validarFichero($_FILES['ficheroresumen'], $id, 'ficheroresumen');
        // if(!$this->validarFichero($_FILES['ficheroresumen'],$id,'ficheroresumen')){
        //     $this->errores->AnotaError('ficheroresumen','Error al cargar el archivo');
        // }

        //Filtramos el fichero subido
        $this->validarFichero($_FILES['fotos'], $id, 'fotos');
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
        if ($nombreFichero['error'] == 0) {

            $dir = ASSETS_PATH . "uploads/";
            $tamano_max = 30000; //kb
            $ext_permitidas = array('doc', 'docx', 'odt', 'pdf', 'jpg', 'jpeg', 'png');
            $ruta_carga = $dir . $id . "_" . $nombreFichero['name'];
            $arr_archivo = explode(".", $nombreFichero['name']);
            $extension = strtolower(end($arr_archivo));

            if (in_array($extension, $ext_permitidas)) {
                if ($nombreFichero['size'] < $tamano_max * 1024) {
                    if (!file_exists($dir)) {
                        mkdir($dir, 0777);
                    }
                    if (move_uploaded_file($nombreFichero['tmp_name'], $ruta_carga)) {
                        return true; // se ha subido correctamente
                    } else {
                        return false; // error al cargar el archivo
                    }
                } else {
                    $this->errores->AnotaError($campo, 'El archivo excede el tamaño permitido');
                    return false;
                }
            } else {
                $this->errores->AnotaError($campo, 'Archivo no permitido');
                return false;
            }
        } elseif ($nombreFichero['error'] == 4) {
            $this->errores->AnotaError($campo, 'No has subido archivo');
            return false;
        } else {
            $this->errores->AnotaError($campo, 'Error en la subida del archivo');
            return false;
        }
    }
}
