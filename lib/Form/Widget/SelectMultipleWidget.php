<?php
	namespace Form\Widget;
	
	use Mvc\View\View;

	class SelectMultipleWidget extends FormWidget {
		protected $widgetTemplateFile = "select/multiple.tmp";
		
		public function render($name, $data){
			$data['name'] = $name;
			echo $this->parseTemplate($data);
		}
	}