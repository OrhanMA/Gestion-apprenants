<?php

function classLoader($className)
{
  $filePathClass = $className . '.php';

  $folderPathClasses = __DIR__ . '/Classes/';
  $folderPathModels = __DIR__ . '/Models/';
  $folderPathRepositories = __DIR__ . '/Repositories/';
  $folderPathControllers = __DIR__ . '/Controllers/';
  $folderPathTraits = __DIR__ . '/Traits/';
  $folderPathInterfaces = __DIR__ . '/Interfaces/';


  if (file_exists($folderPathClasses . $filePathClass)) {
    require $folderPathClasses . $filePathClass;
  }

  if (file_exists($folderPathModels . $filePathClass)) {
    require $folderPathModels . $filePathClass;
  }

  if (file_exists($folderPathRepositories . $filePathClass)) {
    require $folderPathRepositories . $filePathClass;
  }

  if (file_exists($folderPathControllers . $filePathClass)) {
    require $folderPathControllers . $filePathClass;
  }

  if (file_exists($folderPathTraits . $filePathClass)) {
    require $folderPathTraits . $filePathClass;
  }

  if (file_exists($folderPathInterfaces . $filePathClass)) {
    require $folderPathInterfaces . $filePathClass;
  }
}


spl_autoload_register('classLoader');

if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

$database = new Database();

require_once __DIR__ . '/router.php';
