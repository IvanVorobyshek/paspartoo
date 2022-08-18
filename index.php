<?php
//MySQL - 5.6
//PHP 7.4
//register classes
spl_autoload_register(function ($classname) {
    $trans = array("\\" => "/");
    $classname = strtr($classname, $trans);
    include __DIR__ . "/src/" . $classname . ".php";
});

Project\Services\Routes::Routing();