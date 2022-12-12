<?php
// Evitamos errores "deprecated" en php 8.1 que tenemos con la versión de jessengers blade
error_reporting(E_ERROR | E_WARNING | E_PARSE);
/* 
 * CONTROLADOR FRONTAL utilizando slim (Véase ejemplos anteriores para explicaciónes sobre como instalar
 */

// Estamos trabajando con espacios de nombres, hay objetos que queremos simplificar su nombre
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


//
// URL en la que se encuentra la aplicación. Se precisa para crear los enlaces
// BASE_URL si utilizáis XAMMP será 
// http://localhost/carpeta/index.php/
//
// Si utilizamos como servidor el interprete de php ejecutando en el terminal
// php -S localhost:8000
define('BASE_URL', 'http://localhost:3000/index.php/');
// define('BASE_URL', 'http://localhost/appPHP/index.php/');

require __DIR__ . '/vendor/autoload.php'; // Autocargador para los componentes instalados desde composer (en este caso Slim y blade)
require __DIR__ . '/ctes.php'; // definimos constantes que facilitan el trabajo

include(MODEL_PATH . 'Session.php');     // Clase session
include(CTRL_PATH . 'LoginCtrl.php');      // Controlador de login
include(CTRL_PATH . 'TareasCtrl.php');      // Controlador de tarea
include(CTRL_PATH . 'UsuariosCtrl.php');      // Controlador de usuarios


// Habilitamos errores detallados para que nos informe de cualquier contratiempo
// https://www.slimframework.com/docs/v3/handlers/error.html
/**
 * Instantiate App
 * Creamos la aplicación
 */
$app = new \Slim\App(['settings' => ['displayErrorDetails' => true,],]);

// Definimos rutas que procesamos
// RUTA PARA EL INICIO DE LA APLICACIÓN, REDIRIGE A LOGIN
$app->any('/', function (Request $request, Response $response, $args) {
    return LoginCtrl::getInstance()->login();
});

//
//  RUTAS PARA LOGIN/LOGOUT
//

// Página de login (observad que entramos por get/post/put/... al poner any())
$app->any('/login', function (Request $request, Response $response, $args) {
    return LoginCtrl::getInstance()->login();
});

// Página de logout
$app->get('/logout', function (Request $request, Response $response, $args) {
    LoginCtrl::getInstance()->logout();
});


//
// RUTAS QUE PROCESAN LAS TAREAS
//

// ====ADMIN====

// Listar admin (página principal)
$app->get('/listar', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyAdminLogged();
    return (new TareasCtrl())->Listar();
});

// Nueva tarea admin
$app->any('/nuevatarea', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyAdminLogged();
    return (new TareasCtrl())->NuevaTarea();
});

// Listar tareas pendientes admin
$app->get('/listartareaspendientes', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyAdminLogged();
    return (new TareasCtrl())->ListarTareasPendientes();
});

// Listar usuarios admin
$app->get('/listarusuarios', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyAdminLogged();
    return (new UsuariosCtrl())->ListarUsuarios();
});

// Editar usuario admin
$app->get('/editarusuario', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyAdminLogged();
    return (new UsuariosCtrl())->EditarUsuario();
});

// Ver detalles de la tarea admin
$app->get('/detalles', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyAdminLogged();
    return (new TareasCtrl())->DetallesTarea();
});

// Modificar
$app->any('/edit', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyAdminLogged();
    return (new TareasCtrl())->Edit();
});

// Borrar
$app->get('/del', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyAdminLogged();
    return (new TareasCtrl())->Del();
});

//Confirmación borrar tarea
$app->any('/confirmardelete', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyAdminLogged();
    return (new TareasCtrl())->ConfirmarDelete();
});

// ====OPERARIO====

// Listar OPERARIO
$app->get('/operariolistar', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyOperarioLogged();
    return (new TareasCtrl())->operarioListar();
});

// Listar tareas pendientes operario
$app->get('/operariolistartareaspendientes', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyOperarioLogged();
    return (new TareasCtrl())->operarioListarTareasPendientes();
});

// Ver detalles de la tarea operario
$app->get('/operariodetallestarea', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyOperarioLogged();
    return (new TareasCtrl())->DetallesTareaOperario();
});

// Completar tarea operario
$app->any('/completartarea', function (Request $request, Response $response, $args) {
    Session::getInstance()->onlyOperarioLogged();
    return (new TareasCtrl())->completarTarea();
});


// Run app
$app->run();