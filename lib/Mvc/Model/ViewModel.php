<?php
	namespace Mvc\Model;
	
	use Mvc\View\View;

	class ViewModel extends BaseModel {
		private $showLayout = true;
		
		public function getTemplateName(){
			return "layout/templates/" . $this->controllerName ."/".$this->actionName .".tmp";
		}
		
		public function getDefaultTemplateName(){
			return "layout/base_templates/" .$this->actionName .".tmp";	
		}
		
		public function disableLayouts(){
			$this->showLayout = false;
		}
		
		public function getLayoutName(){
			return "layout/layout.tmp";
		}
		
		public function commit(){
			$template = $this->getTemplateName();
				
			if(!file_exists($template)){
				$template = $this->getDefaultTemplateName();
			}
			
			$view = new View($template, $this->getLayoutName());
			$view->set($this->registry);
			
			if($this->showLayout){
				$view->show();
			} else {
				echo $view->parse($template);
			}
		}
	}