<?php
	namespace Translation;
	
	use Config;
	
	class Language {
		private static $instance = null;
		
		private $currentLanguage = "";
		
		private $activeLanguages = array();
		
		private $translatable = array();
		
		public static function getInstance(){
			if(self::$instance == null){
				self::$instance = new Language();
			}
			
			return self::$instance;
		}
		
		public function getActiveLang(){
			return $this->currentLanguage;
		}
		
		public function __construct(){
			$this->currentLanguage = Config::getInstance()->getConfig("currentLanguage",'en');

			if(isset($_SESSION['currentLanguage'])){
				$this->currentLanguage = $_SESSION['currentLanguage'];
			}
			
			$this->activeLanguages = Config::getInstance()->getConfig("languages", array('en'));
			
			$this->readTranslations();
		}
		
		public function readTranslations(){
			$this->translatable = array(
				"Username" => array(
					"en" => "Username",
					"bg" => "Потребителско име"
				),
			);
		}
		
		public function setLanguage($language){
			$this->currentLanguage = $language;
		}
		
		public function translate($text){
			if(isset($this->translatable[$text])){
				return $this->translatable[$text][$this->currentLanguage];
			}
			
			return $text;
		} 
	}