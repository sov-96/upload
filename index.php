<?
require_once('auto.php');

$router = new \core\Controller\AltoRouter();


$router->map('GET','/', function(){

    \core\View\navigation::navigator($_REQUEST['page'],2,'advertising', "mysql:host=127.0.0.1;dbname=upload;charset=utf8");

});
$router->map('GET','/uplpage', function(){

   include (__DIR__.'tempalates\uplpage.php');
});

$router->map('GET','/pages/@name',  function($title){
//echo $title;
    coutput::outbyname($title);
});


$router->matchAll();