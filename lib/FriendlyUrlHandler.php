<?php
	class FriendlyUrlHandler implements RoutingStrategy{
		public function buildUrl($params){
			$route = join("/", $params);
			
			return APP_MAIN_URL . $route;
		}
		
		public function getParam($paramName){
			return Request::getInstance()->getParam($paramName);
		}
	}