<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


$routes = [
    '/' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/notes' => 'controllers/notes.php',
    '/note' => 'controllers/note.php',
    '/contact' => 'controllers/contact.php',

];

function routeToController($uri,$routes){
    if (array_key_exists($uri,$routes)){
        require $routes[$uri];
    }else{
        abort();
    }
}


function abort($code = 404){ // this is the default value of $code.
    http_response_code($code);

    require("views/{$code}.php");

    die();
}

routeToController($uri,$routes);

?>