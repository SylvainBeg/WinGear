<?php
// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => 'localhost',
    'port'     => '3306',
    'dbname'   => 'WinGear',
    'user'     => 'WinGear_user',
    'password' => 'secret',
);