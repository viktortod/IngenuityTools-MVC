<?php
	namespace Mvc\Model;
	
	use Mvc\Db\DbTable;
	
	use Request;

	class DataMapper {
		private $subject;
		
		public function __construct(DbTable $subject){
			$this->subject = $subject;
		}
		
		public function getInputData(){
			$inputParams= $this->subject->describe();
			dump($inputParams);
			$inputData = Request::getInstance()->getArray($inputParams);
			return $inputData;
		}
	}