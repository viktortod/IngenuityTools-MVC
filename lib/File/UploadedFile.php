<?php
	namespace File;
	/**
	 * Provides uploaded file manipulations
	 * @author Viktor Todorov
	 * @version 1.0
	 */
	class UploadedFile {
		/**
		 * file information
		 * @var array
		 * @access private
		 */
		private $fileInfo;
		/**
		 * Filename key
		 * @var string
		 * @access private
		 */
		private $key;
		/**
		 * Object constructor
		 * @param $key string
		 */
		public function __construct($key){
			$this->key = $key;
			$this->fileInfo = $_FILES[$key];
		}
		/**
		 * Move uploaded file to given destination if file validation pass
		 * @param $asType file's type
		 * @param $destination the destination directory
		 */
		public function upload($asType, $destination){
			if(empty($this->fileInfo['tmp_name'])){
				throw new \Exception("No file uploaded");
			}
			
			$filename = time() . $this->fileInfo['name'];
			if($this->checkFile($asType)){
				move_uploaded_file($this->fileInfo['tmp_name'], $destination . $filename);
			}
			
			return  $filename;
		}
		protected function getFileName(){
			return time() . $this->fileInfo['name'];
		}
		
		public function checkFile($type){
			$mimePrimary = explode("/", $this->fileInfo['type']);
			return ($type == $mimePrimary[0]);
		}
	}