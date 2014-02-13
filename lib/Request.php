<?php
	/**
	 * Request parameters handler
	 * @author Viktor Todorov
	 * @version 1.0
	 * @final
	 */
	final class Request {
		/**
		 * Singleton's instance
		 * @var Request
		 * @access private
		 * @staticvar
		 */
		private static $instance = null;
		/**
		 * @access private
		 * @var array
		 */
		private $registry;
		/**
		 * Gets the single request instance
		 * @static
		 * @access public
		 * @return Request
		 */
		public static function getInstance(){
			if(self::$instance == null){
				self::$instance = new Request();
			}
			
			return self::$instance;
		}
		/**
		 * Prevents instantiating the Request class
		 * @access private
		 */
		private function __construct(){
			$paramsList = $_POST + $_GET;
			$this->setArray($paramsList);
		}
		/**
		 * sets a key value pair to the request
		 * @param $paramsList array
		 */
		public function setArray($paramsList){
			foreach ($paramsList as $param =>$value){
				$this->set($param, $value);
			}
		}
		/**
		 * Sets a parameter value
		 * @param $param string the param name
		 * @param $value mixed the param value
		 * @access public
		 */
		public function set($param, $value){
			$this->registry[$param] = $value;
		}
		/**
		 * Gets key value pair, containing parameters in the list
		 * @param $paramsList a list of parameters
		 * @access public
		 * @return array
		 */
		public function getArray(array $paramsList){
			$return = array();
			foreach ($paramsList as $param){
				$return[$param] = $this->getParam($param, '');
			}
			
			return $return;
		}
		/**
		 * Gets param value. If param is not set, method will return default value
		 * @param $param string The name of the param
		 * @param $defaultValue string The value, witch will be returned
		 * @access public
		 * @return mixed
		 */
		public function getParam($param, $defaultValue=""){
			if(!isset($this->registry[$param])){
				return $defaultValue;
			}
			
			return $this->registry[$param];
		}
	}