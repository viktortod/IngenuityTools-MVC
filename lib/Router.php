<?php
	class Router {
		private static $instance=null;
		
		private $routingStrategy;
		
		public static function getInstance(){
			if(self::$instance==null){
				self::$instance = new Router();
			}
			
			return self::$instance;
		}
		
		private function __construct(){
			$this->routingStrategy = new FriendlyUrlHandler();
		}
		
		public function getUrlHandler(){
			return $this->routingStrategy;
		}
		
		public function getController(){
			return $this->routingStrategy->getParam('controller');
		}
		
		public function redirect($controller, $action='index', $id=''){
			$location = APP_MAIN_URL . "$controller/$action/$id";
			
			header("Location: $location");
			exit();
		}
		
		public function getLibPath(){
			return APP_MAIN_PATH . "/lib/";
		}
		
		public function getFormWidgetsPath(){
			return APP_MAIN_PATH . "/lib/Form/templates/";
		}
	}