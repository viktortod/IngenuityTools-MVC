<?php
	namespace Form;
	
	class Form {
		private $widgets;
		
		private $action;
		
		private $method;
	
		public function __construct($widgets,$action="save", $method="POST"){
			$this->widgets = $widgets;
			
			$this->action = $action;
			
			$this->method = $method;
		}
		
		public function parseForm($data){
			$content = '<form action="'.APP_MAIN_URL.$this->action.'" method="POST">';
			
			foreach($this->widgets as $label => $widget){
				$content .= "<label>" . t($label) . "</label>";
								
				$content .= $widget->parse(@$data[$widget->getName()]);
			}
			
			$content .= "</form>";
			echo $content;
		}
	}