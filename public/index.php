<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
include 'init_autoloader.php';

$loader = new Zend\Loader\StandardAutoloader();
$loader->registerNamespace('Doctrine', realpath('vendor/Doctrine'));
$loader->register();

// Run the application!
Zend\Mvc\Application::init(include 'config/application.config.php')->run();
