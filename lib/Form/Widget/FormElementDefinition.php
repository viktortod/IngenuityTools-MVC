<?php
	namespace Form\Widget;
	
	class FormElementDefinition {
		protected $class = null;
		
		protected $tagName;
		
		protected $name;
		
		protected $id;
		
		// protected $class;
		
		protected $innerHTML;
		
		public function __construct($data){
			foreach($data as $label => $value){
				$this->$label = $value;
			}
		}
		
		public function get($field){
			$customMethod = "get" . ucfirst($field);
			
			if(method_exists($this,$customMethod)){
				return $customMethod;
			}
			
			return $this->$field;
		}
		
		public function setValue($value){
			$this->innerHTML = $value;
		}
		
		public function parseAttributes($value){
			$this->setValue($value);
		
			$attributes = "";
			foreach(get_object_vars($this) as $element=>$value){
				if($element == "innerHTML" || empty($value) || $element == "tagName"){
					continue;
				}
				
				$attributes .= " {$element}=\"{$value}\"";
			}
			
			return $attributes;
		}
	}