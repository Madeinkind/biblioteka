<?php
/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/

// установим заголовки
header('Access-Control-Allow-Credentials: true');
//header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, PATCH, OPTIONS, HEAD');
//header('Access-Control-Allow-Headers: *');
//header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Origin, Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: '.gmdate( 'D, d M Y H:i:s').' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Content-type: text/plain');

$app = require __DIR__.'/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/
$app->run();
