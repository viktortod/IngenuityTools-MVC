<?php
	namespace Form;
	
	class Generator {
		private $widgets = array();
		
		public function __construct(){
			$this->buildWidget('input');
			$this->buildWidget('textarea');
			$this->buildWidget('SelectMultiple');
			$this->buildWidget('DynRows');
		}
		
		public function buildWidget($type){
			$namespace = "\\Form\\Widget\\";

			$className = $namespace . ucfirst($type) . "Widget";
			
			if(class_exists($className)){
				$this->widgets[$type] = new $className;
			}
		}
		
		public function show($type, $name, $data){
			$this->widgets[$type]->render($name, $data);
		}
	}