<?php
	namespace Mvc\Controller;
	
	use Exception;
	
	use Request;
	
	class ControllerDispatcher {
		private $mainParams = array();
		
		public function __construct($controllerParam, $actionParam){
			$this->mainParams['controller'] = $this->sanitize($controllerParam);
			$this->mainParams['action'] = $actionParam;
		}
		
		private function sanitize($param){
			return ucfirst($param);
		}
		
		public function dispatch(){
			$controllerClass = "App\\Controller\\". $this->mainParams['controller'] . "Controller";
			// dump($controllerClass);
			//if(!class_exists($controllerClass)){
			//	throw new Exception("Invalid path");
			//}
			
			$controllerInstance = new $controllerClass();
			
			if(!$controllerInstance instanceof BaseController){
				throw new Exception('Invalid controller param');
			} 
			
			$action = $this->mainParams['action']."Action";
			
			if(!method_exists($controllerInstance, $action)){
				throw new Exception('Invalid action param');
			}
			
			$id = Request::getInstance()->getParam('id',-1);
			if($id != -1){
				return $controllerInstance->$action($id);
			} else {
				return $controllerInstance->$action();
			}
		}
		
		public function getControllerName(){
			$controllerClass = "App\\Controller\\". $this->mainParams['controller'] . "Controller";
			if(Request::getInstance()->getParam('is_module', 0)){
				
			}
		}
	}