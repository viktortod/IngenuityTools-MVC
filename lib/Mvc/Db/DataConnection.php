<?php
	namespace Mvc\Db;
	
	class DataConnection{
		protected static $instance = null;
		
		/**
		 * @return CMS\Db\DbDriver
		 */
		public static function getInstance(){
			$driverId = DB_DRIVER;
			$driverClassName = "Mvc\\Db\\".ucfirst($driverId). "DbDriver";
			if(self::$instance == null){
				self::$instance = new $driverClassName();
				self::$instance->connect(array(
					'db' => DB_DATABASE,
					'host' => DB_HOST_ADDRESS,
					'username' => DB_USERNAME,
					'password' => DB_PASSWORD,
					'port' => ''
				));
			}
			
			return self::$instance;
		}
		
		public static function escapeData($data){
			return self::getInstance()->escape($data);
		}
	}