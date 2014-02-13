<?php
	namespace Mvc\Db;
	
	use PDOStatement;
	
	interface DbDriver {
		/**
		 * 
		 * Enter description here ...
		 * @param unknown_type $query
		 * @return PDOStatement
		 */
		public function execQuery($query);
		public function connect($connectionParams);
		public function fetch($query);
		public function fetchColumn($query,$columnIndex);
		public function fetchAll($query);
		public function getNumberAffectedRows(PDOStatement $resource);
		public function startTransaction();
		public function commitTransaction();
		public function rollbackTransaction();
		
		public function escape($data);
	}