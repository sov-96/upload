<?
// начиная с версии PHP 5.3.0 можно использовать безымянные функции
/*
spl_autoload_register(function ($class) {
    if( mb_strpos(''.$class,'flight')===0)  return true;
    include 'class/' . $class . '.php';
});*/

spl_autoload_extensions(".php");
spl_autoload_register();