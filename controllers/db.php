<?php
$root = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
include $root.'/config.php';
require $root.'/vendor/autoload.php';
require $root.'/entities/categoria.php';
require $root.'/mappers/categoria.php';
require $root.'/entities/historial.php';
require $root.'/mappers/historial.php';
require $root.'/entities/lista.php';
require $root.'/mappers/lista.php';
require $root.'/entities/marca.php';
require $root.'/mappers/marca.php';
require $root.'/entities/producto_lista.php';
require $root.'/mappers/producto_lista.php';
require $root.'/entities/producto.php';
require $root.'/mappers/producto.php';
require $root.'/entities/usuario_categoria.php';
require $root.'/mappers/usuario_categoria.php';
require $root.'/entities/usuario_lista.php';
require $root.'/mappers/usuario_lista.php';
require $root.'/entities/usuario.php';
require $root.'/mappers/usuario.php';
$cfg = new \Spot\Config();
// MySQL
$connString = [
    'dbname' => 'espheras_superlist',
    'user' => 'espheras_dbuser',
    'password' => 'Goingupinlife123',
    'host' => '162.210.98.37',
    'driver' => 'pdo_mysql'    
    ];
$cfg->addConnection('mysql', $connString);
/*$cfg->addConnection('mysql', [
    'dbname' => 'coupons',
    'user' => 'dbuser',
    'password' => 'Goingup123',
    'host' => 'localhost',
    'driver' => 'pdo_mysql'
]);*/
$spot = new \Spot\Locator($cfg);