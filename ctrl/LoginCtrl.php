<?php

/**
 * Controlador que me permitirá gestionar las interacciones que realicemos para hacer login
 */

use Jenssegers\Blade\Blade;

include(HELPERS_PATH . 'GestorErrores.php');
include(HELPERS_PATH . 'form.php');


/**
 * LoginCtrl es la clase manejadora de los eventos relacionados con el login y el inicio de sesión de los usuarios
 *
 * @author José María Gil Leal
 * Fecha de creación 3 diciembre 2022
 * versión 2.0
 */
class LoginCtrl
{
    protected $model = null;
    protected $blade = null;

    /**
     * El constructor de la clase LoginCtrl inicializa el objeto Blade incluido en el paquete de Jenssegers\Blade para renderizar las vistas.
     * @return void
     */
    public function __construct()
    {
        $this->blade = new Blade(VIEW_PATH, CACHE_PATH);
    }

    /**
     * Devuelve un objeto de tipo LoginCtrl
     * @return object
     */
    public static function getInstance(): object
    {
        return new self();
    }

    /**
     * Muestra el formulario para iniciar sesión y valida si el usuario está en la base de datos. En caso que exista el usuario, identifica el rol y redirige a la vista correspondiente. Si hay algún error, lo almacena en el objeto GestorErrores y vuelve a mostrar el login.
     * @return string
     */
    public function login(): string
    {
        $ge = new GestorErrores('<span style="color:red">', '</span>');
        if ($_POST) {
            // Verificamos si es login correcto con user/passwd
            if (Session::getInstance()->login(
                filter_input(INPUT_POST, 'user'),
                filter_input(INPUT_POST, 'passwd')
            )) {
                // Ha entrado, redirigimos a la página de listar tareas
                // var_dump(Session::getInstance()->onlyLogged());
                // exit;
                if(Session::getInstance()->isAdmin()){
                    Session::redirect('/listar');
                }elseif(Session::getInstance()->isOperario()){
                    Session::redirect('/operariolistar');
                }
                // Aquí no se llega, redirect ha finalizao el script
            }
            // Login fallido, hay error
            $ge->AnotaError('user', 'Usuario o clave incorrectos');
        }
        // Mostramos los datos
        return $this->blade->render('login', ['ge' => $ge]);
    }

    /**
     * Cierra la sesión llamando al método logout de la clase Session y redirige al login.
     * @return void
     */
    public function logout()
    {
        Session::getInstance()->logout();
        Session::redirect('/login');
    }
}