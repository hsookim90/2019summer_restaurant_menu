<?php
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define ("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');
  // define ("WWW_ROOT", PUBLIC_PATH);
  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", $doc_root);
  require_once('functions.php');
  require_once('db_credentials.php');
  require_once('database_functions.php');
  require_once('status_error_functions.php');
  require_once('validation_functions.php');

  //$db = db_connect();

  foreach(glob('classes/*.class.php') as $file)
  {
    require_once($file);
  }

  function my_autoload($class)
  {
    if(preg_match('/\A\w+\Z/', $class))
    {
      include('classes/' . $class . '.class.php');
    }
  }
  spl_autoload_register('my_autoload');
  $database = db_connect();
  DatabaseObject::set_database($database);
  $session = new Session;
 ?>
