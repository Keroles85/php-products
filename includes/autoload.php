<?php

spl_autoload_register(function($className) {
  try {
    $file = dirname(__DIR__) . "/classes/{$className}.php";
    if(file_exists($file)) {
      include $file;
    }
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }

});