<?php

use Jenssegers\Blade\Blade;

include(HELPERS_PATH . 'GestorErrores.php');
include(HELPERS_PATH . 'form.php');
include(MODEL_PATH . 'tareas.php');

/**
 * Description of Tareas
 *
 * @author santi
 * Fecha de creación 2 diciembre 2022
 * versión 1.0
 */
class TareasCtrl
{
    protected $model = null;
    protected $errores = null;
    protected $blade = null;

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
     * Devuelve un objeto de tipo Tareas
     *
     * @return void
     */
    public static function getInstance()
    {
        return new self();
    }


    /**
     * Muestra la página de Inicio
     */
    public function Inicio()
    {
        // En un controlador real esto haría más cosas
        return $this->blade->render('inicio');
    }

    /**
     * Muestra la página para registrar nuevas tareas
     */
    public function NuevaTarea()
    {
        if (!$_POST) {
            // Primera vez.
            $tarea = array(
                'nif' =>  '',
                'nombre' => '',
                'apellidos' => '',
                'telefono' => '',
                'correo' => '',
                'poblacion' => '',
                'codpostal' => '',
                'provincia' => '',
                'direccion' => '',
                'estado' => '',
                'fechacreacion' => '',
                'operario' => '',
                'fechatarea' => '',
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
            // Lo creamos a partir de los datos recibidos del POST
            $tarea = array(
                'nif' =>  VPost('nif'),
                'nombre' => VPost('nombre'),
                'apellidos' => VPost('apellidos'),
                'telefono' => VPost('telefono'),
                'correo' => VPost('correo'),
                'poblacion' => VPost('poblacion'),
                'codpostal' => VPost('codpostal'),
                'provincia' => VPost('provincia'),
                'direccion' => VPost('direccion'),
                'estado' => VPost('estado'),
                'fechacreacion' => VPost('fechacreacion'),
                'operario' => VPost('operario'),
                'fechatarea' => VPost('fechatarea'),
                'anotacionanterior' => VPost('anotacionanterior'),
                'anotacionposterior' => VPost('anotacionposterior'),
                'descripcion' => VPost('descripcion'),
                'ficheroresumen' => VPost('ficheroresumen'),
                'fotos' => VPost('fotos'),
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
        // En un controlador real esto haría más cosas
        return $this->blade->render('nuevatarea');
    }

    /**
     * Muestra la página para registrar nuevas tareas
     */
    public function ConfNuevaTarea()
    {
        // En un controlador real esto haría más cosas
        return $this->blade->render('confnuevatarea');
    }

    /**
     * Muestra la lista de tareas
     */
    public function Listar()
    {
        $tareas = $this->model->GetTareas();

        // En un planteamiento real puede que incluyesemos más cosas
        return $this->blade->render('listar', ['tareas' => $tareas]);
    }

    /**
     * Permite modificar una tarea seleccionada
     *
     * @return void
     */
    public function Edit()
    {
        if (!isset($_GET['id'])) {
            // No existe la tarea, error
            return $this->blade->render('edit_error', [
                'descripcion_error' => 'No existe la tarea seleccionada'
            ]);
        }

        // Han indicado el id
        $id = $_GET['id'];


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
                    'operacion' => 'Edición',
                    'tarea' => $tarea,
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
                'nombre' => VPost('nombre'),
                'apellidos' => VPost('apellidos'),
                'telefono' => VPost('telefono'),
                'correo' => VPost('correo'),
                'poblacion' => VPost('poblacion'),
                'codpostal' => VPost('codpostal'),
                'provincia' => VPost('provincia'),
                'direccion' => VPost('direccion'),
                'estado' => VPost('estado'),
                'fechacreacion' => VPost('fechacreacion'),
                'operario' => VPost('operario'),
                'fechatarea' => VPost('fechatarea'),
                'anotacionanterior' => VPost('anotacionanterior'),
                'anotacionposterior' => VPost('anotacionposterior'),
                'descripcion' => VPost('descripcion'),
                'ficheroresumen' => VPost('ficheroresumen'),
                'fotos' => VPost('fotos'),
            );

            if ($this->errores->HayErrores()) {
                // Mostrar ventana de nuevo
                return $this->blade->render('edit', array(
                    'operacion' => 'Edición',
                    'tarea' => $tarea,
                    'errores' => $this->errores
                ));
            } else {
                // Guardamos la tarea
                $this->model->Update($id, $tarea);
                return $this->blade->render('msg', [
                    'descripcion' => "<p>Se ha guardado la tarea ....</p>"
                ]);
            }
        }
    }

    /**
     * Añade una nueva tarea
     * @return type
     */
    public function Add()
    {
        if (!$_POST) {
            // Primera vez.
            $tarea = array(
                'nombre' =>  '',
                'prioridad' => ''
            );
        } else {
            // Filtrar datos
            $this->FiltraCamposPost();

            // Creamos el objeto tarea que es el que se utiliza en el formulario
            // Lo creamos a partir de los datos recibidos del POST
            $tarea = array(
                'nombre' =>  VPost('nombre'),
                'prioridad' => VPost('prioridad')
            );

            if (!$this->errores->HayErrores()) {
                // Guardamos la tarea y finalizamos
                $this->model->Add($tarea);
                Session::redirect('/listar');
            }
        }
        // Mostramos los datos
        return $this->blade->render('edit', array(
            'operacion' => 'Insertar',
            'tarea' => $tarea,
            'errores' => $this->errores
        ));
    }

    /**
     * Borra una nueva tarea
     * @return type
     */
    public function Del()
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
                'descripcion' => 'No existe la tarea seleccionada para borrar'
            ]);
        }
    }






    /**
     * Realiza el filtrado de campos y almacena los errores en el gestor de errores
     * @param GestorErrores $this->errores
     */
    public function FiltraCamposPost()
    {
        // Filtramos el nif
        if (VPost('nif') == '') {
            $this->errores->AnotaError('nif', 'Se debe introducir texto');
        } elseif (strlen(VPost('nif')) < 9 || strlen(VPost('nif')) > 9) {
            $this->errores->AnotaError('nif', 'El NIF debe tener 8 dígitos y una letra');
        } elseif (!validarNie(VPost('nif'))) {
            $this->errores->AnotaError('nif', 'El NIF no es correcto');
        }

        // Filtramos el nombre
        if (VPost('nombre') == '') {
            $this->errores->AnotaError('nombre', 'Se debe introducir texto');
        }

        // Filtramos los apellidos
        if (VPost('apellidos') == '') {
            $this->errores->AnotaError('apellidos', 'Se debe introducir texto');
        }

        // Filtramos el telefono
        if (VPost('telefono') == '') {
            $this->errores->AnotaError('telefono', 'Se debe introducir texto');
        } elseif (!is_string($_POST['telefono'])) {
            $this->errores->AnotaError('telefono', "Compruebe el número de teléfono");
        } elseif (strlen(VPost('telefono')) < 9) {
            $this->errores->AnotaError('telefono', 'El teléfono debe tener 9 digitos');
        }

        // Filtramos el correo
        if (VPost('correo') == '') {
            $this->errores->AnotaError('correo', 'Se debe introducir texto');
        } elseif (filter_input(INPUT_POST, 'correo', FILTER_VALIDATE_EMAIL) == '') {
            $this->errores->AnotaError('correo', "El correo no válido");
        }

        // Filtramos la población
        if (VPost('poblacion') == '') {
            $this->errores->AnotaError('poblacion', 'Se debe introducir texto');
        }

        // Filtramos el código postal
        if (VPost('codpostal') == '') {
            $this->errores->AnotaError('codpostal', 'Se debe introducir texto');
        }

        // Filtramos la provincia
        if (VPost('provincia') == '') {
            $this->errores->AnotaError('provincia', 'Se debe introducir texto');
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
        $_POST['fechacreacion'] = date("d-m-y");
        if (VPost('fechacreacion') == '') {
            $this->errores->AnotaError('fechacreacion', 'Se debe introducir una fecha');
        }

        // Filtramos el operario
        if (VPost('operario') == '') {
            $this->errores->AnotaError('operario', 'Se debe introducir texto');
        } elseif (is_numeric(VPost('operario'))) {
            $this->errores->AnotaError('operario', "Por favor, introduce un nombre sin números ni carácteres especiales");
        }

        if (VPost('fechatarea') == '') {
            $this->errores->AnotaError('fechatarea', 'Se debe introducir una fecha');
        }

        // // Filtramos la prioridad
        // $prioridad = VPost('prioridad');
        // if ($prioridad == '') {
        //     $this->errores->AnotaError('prioridad', 'Se debe introducir texto');
        // } elseif (!is_numeric($prioridad) || ($prioridad < 1 || $prioridad > 5)) {
        //     $this->errores->AnotaError('prioridad', 'La prioridad debe ser un número entre 1 y 5');
        // }
    }
    // public function FiltraCamposPost()
    // {
    //     // Filtramos el nombre
    //     if (VPost('nombre') == '') {
    //         $this->errores->AnotaError('nombre', 'Se debe introducir texto');
    //     } elseif (strlen(VPost('nombre')) < 5) {
    //         $this->errores->AnotaError('nombre', 'El nombre debe tener al menos 5 letras');
    //     }

    //     // Filtramos la prioridad
    //     $prioridad = VPost('prioridad');
    //     if ($prioridad == '') {
    //         $this->errores->AnotaError('prioridad', 'Se debe introducir texto');
    //     } elseif (!is_numeric($prioridad) || ($prioridad < 1 || $prioridad > 5)) {
    //         $this->errores->AnotaError('prioridad', 'La prioridad debe ser un número entre 1 y 5');
    //     }
    // }
}
