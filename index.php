<?php 
    require_once 'config.php';

    $url = (isset($_GET["url"])) ? $_GET["url"]: "Login_facebook/login";//Colocar el nombre del controlador, seguido por la funcion que va a cargar en un inicio en este caso lofin
    $url = explode("/",$url);

    if( isset($url[0]) && $url[0] != '' ) { $controller =  $url[0]; }
    if( isset($url[1]) && $url[1] != '' ) { $method = $url[1]; }
    if( isset($url[2]) && $url[2] != '' ) { $params = $url[2]; }

    spl_autoload_register(function($class){
        if(file_exists("libs/{$class}.php")){
            require_once "libs/{$class}.php";
        }
    });

    $path = "./controllers/{$controller}.php";
    if(file_exists($path)){
        require_once $path;
        $controller = new $controller();
        if(isset($method)){
            if(method_exists($controller, $method)){
                if(isset($params)){
                    $controller->{$method}($params);
                }else{
                    $controller->{$method}();
                }
            } else {
                $controller->pageNotFound();
            }
        }else{
                $controller->index();
        }
    } else {
        $controller = new Controller();
        $controller->pageNotFound();
    }
?>