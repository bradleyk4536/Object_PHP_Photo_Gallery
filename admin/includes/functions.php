<?php
//check and autoload all classes not included in application
 function classAutoLoader($class) {

	$class = strtolower($class);

	$the_path = "includes/{$class}.php";


	if(is_file($the_path) && !class_exists($class)) {

		require_once $the_path;
	}
 }

//redirect user to specified page
function redirect($path){

	header("Location: {$path}");
}
spl_autoload_register('classAutoLoader');

?>
