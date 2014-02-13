<?php
	namespace Mvc\Model;
	
	class RedirectModel extends BaseModel {
		public function commit(){
			$controller = strtolower(str_replace("Controller","",$this->registry['controller']));
			$action = $this->registry['action'];
			
			$address = APP_MAIN_URL."{$controller}/{$action}/";
			header('Location: '.$address);
			exit();
		}
	}