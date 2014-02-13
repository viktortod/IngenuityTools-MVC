<?php
	namespace Form\Widget;
	
	use SimpleXmlElement;
	
	class FormWidget implements IWidget {
		protected $element;
		
		protected $name;
		
		public function __construct($elementName,$formElementDefinition){
			$this->element = $formElementDefinition;
			$this->name = $elementName;
		}
		
		public function getName(){
			return $this->name;
		}
		
		public function parse($data){
			$content = "<" . $this->element->get("tagName") . " " . $this->element->parseAttributes($data) ;
			$close = "</" . $this->element->get("tagName")  .  ">";
			if($this->element->get("innerHTML") == ""){
				$content .= "/";
				
				$close = "";
			}
			return  $content .  ">" . $this->element->get("innerHTML") . $close;
		}
	}