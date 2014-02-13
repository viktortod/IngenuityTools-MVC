<?php
	namespace Mvc;
	
	use Mvc\Model\BaseModel;
	use Request;
	use Config;
	use Mvc\Controller\ControllerDispatcher;

	class Application {
		public static function init($settings){
			header("Content-type: text/html; charset=UTF-8;");
			session_start();
			
//			spl_autoload_register($settings['autoloader_handler']);
			//db
			define('DB_HOST_ADDRESS', $settings['db']['host']);
			define('DB_USERNAME', $settings['db']['username']);
			define('DB_PASSWORD', $settings['db']['password']);
			define('DB_DATABASE', $settings['db']['db']);
			define('DB_DRIVER', $settings['db']['driver']);
			
			$path = (isset($settings['application_path']))?$settings['application_path']:"";
			define("APP_MAIN_PATH", dirname(dirname(dirname(dirname(__FILE__)))).$path);
			define("APP_MAIN_URL", $path);

			if(isset($settings['modules'])){
				$pathToModules = APP_MAIN_PATH . "/app/Modules/";
				// dump($pathToModules);
				foreach($settings['modules'] as $moduleName){
					if(is_dir($pathToModules . $moduleName)){
						$initFile = $pathToModules . $moduleName . "/init.php";
						
						require_once $initFile;
					}
				}
			}
			
			
			Config::getInstance()->init($settings);
			return new Application();
		}
		
		public function execute(){
			
			$controller = Request::getInstance()->getParam('controller','index');
			$action = Request::getInstance()->getParam('action','index');
			
			$dispatcher = new ControllerDispatcher($controller, $action);
			$model = $dispatcher->dispatch();
			
			if(!$model instanceof BaseModel){
				throw new Exception("Invalid model");
			}
			
			$model->setController($controller);
			$model->setAction($action);
			$model->commit();
		}
	}