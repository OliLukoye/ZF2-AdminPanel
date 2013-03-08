<?php
chdir(dirname(__DIR__));
//echo __DIR__;
include __DIR__.'/../../../../init_autoloader.php';
//echo __DIR__.'/../../init_autoloader.php';
Zend\Mvc\Application::init(include '../../config/application.config.php');
