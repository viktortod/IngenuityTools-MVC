<?php
	use Mvc\Application;
	chdir(dirname(__FILE__));
	
	/**
	 * Main Framework autoload function.
	 * @TODO: Move to loader class. Consider Namespace register operation
	 */ 
	function __autoload($className){
		$namespaces = explode('\\', $className);
		$mainDir = 'lib/';
		if(in_array('App', $namespaces)){
			$mainDir = '/';
		}
		
		$class = $namespaces[count($namespaces) - 1] .'.php';
		unset($namespaces[count($namespaces) - 1]);
		$fileLocation = $mainDir . join('/', $namespaces). "/".$class;
		require_once $fileLocation;
	}
	
	/**
	 * This function is used for debuging process. 
	 * @todo Remove from index
	 * @todo Remove from production
	 * @param $mixed mixed value to be dumped
	 */
	function dump($mixed){
		echo "<pre>";
		var_dump($mixed);
		echo "</pre>";
	}

	Application::init(require_once 'config/ingenuity.php')->execute();