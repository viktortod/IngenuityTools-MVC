<?php
	/**
	 * Gets main configs
	 * @author Viktor Todorov
	 * @version 1.0
	 * @final
	 */
	final class Config {
		/**
		 * Singleton's instance
		 * @var Config
		 * @access private
		 * @staticvar
		 */
		private static $instance = null;
		/**
		 * Settings holder
		 * @var array
		 * @access private
		 */
		private $settings;		
		/**
		 * Gets the single configs instance
		 * @static
		 * @access public
		 * @return Config
		 */
		public static function getInstance(){
			if(self::$instance == null){
				self::$instance = new Config();
			}
			
			return self::$instance;
		}
		/**
		 * Empty constructor. Prevents instantiating the Config class
		 * @access private
		 */
		private function __construct(){
			
		}
		/**
		 * Returns configuration value. If no value is set. Returns default value
		 * @param $configName The setting key
		 * @param $defaultValue The default value of the setting
		 * @access public
		 * @return string
		 */
		public function getConfig($configName, $defaultValue){
			if(!isset($this->settings[$configName])){
				return $defaultValue;
			}
			
			return $this->settings[$configName];
		}
		/**
		 * Inits settings
		 * @param $settings array a key value pair of the settings
		 * @access public
		 */
		public function init(array $settings){
			$this->settings = $settings;
		}
	}