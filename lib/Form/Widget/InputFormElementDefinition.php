<?php
	namespace Form\Widget;
	
	class InputFormElementDefinition extends FormElementDefinition{
		protected $type;
		
		protected $value;
		
		protected $tagName = "input";
		
		public function setValue($value){
			if($value != null){
				$this->value = $value;
			}
		}
	}