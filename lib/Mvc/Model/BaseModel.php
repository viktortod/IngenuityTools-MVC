<?php
	namespace Mvc\Model;
	
	abstract class BaseModel {
		protected $controllerName = "";
		protected $actionName = "";
		protected $registry=array();
		
		public function __construct(array $registryParams){
			$this->registry = $registryParams;
		}
		
		public function set($key, $value){
			$this->registry[$key] = $value;
		}
		
		public function setController($controller){
			$this->controllerName = $controller;
		}
		
		public function setAction($action){
			$this->actionName = $action;
		}
		
		abstract public function commit();
	}