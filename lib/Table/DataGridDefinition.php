<?php
	namespace Table;
	
	use Router;
	
	class DataGridDefinition {
		public function __construct(){}
		
		private function __clone(){}
		
		public function getColumnLabels(){
			return array_keys(get_object_vars($this));
		}
		
		public function getIdColumn(){
			return 'id';
		}
		
		public function get($field, $value){
			$method = "format" . ucfirst($field);
			
			if(method_exists($this, $method)){
				return $this->$method($value);
			}
			
			return $value;
		}
		
		public function getColumns(){
			return get_object_vars($this);
		}
		
		public function getOperations($row){
			$controller = Router::getInstance()->getController();
			$id = $row[$this->getIdColumn()];
			
			return array(
				"<a href=\"".APP_MAIN_URL.$controller."/edit/".$id."\">Edit</a>",
				"<a href=\"".APP_MAIN_URL.$controller."/delete/".$id."\">Delete</a>",
			);	
		}
	}