<?php
	namespace Mvc\View;
	
	use Mvc\Controller\BaseController;

	abstract class Block {
		protected $data;
		protected $name;
		
		public function __construct($name, $data=array()){
			$this->data = $data;
			$name = explode('\\', $name);
			$this->name = $name[count($name) - 1];
		}
		
		public function execute(){}
		
		final public function showBlock(){
			$blockPath = APP_MAIN_PATH."/layout/block/" . $this->name . '.tmp';
			$module = searchFile($this->name . '.tmp', "App/Modules/");
			if($module != null){
				$blockPath =  "App/Modules/" . $module;
			}
			
			$view = new View($blockPath, null);
			$view->set(array(
				'data' => $this->data
			));
			echo $view->parse($blockPath);
		}
	}