<?php
	namespace Mvc\Db;
	
	use PDO;
	use PDOStatement;
	
	class MySqlDbDriver implements DbDriver{
		/**
		 * @var PDO
		 */
		private $connection;
		
		public function connect($connectionParams){
			$this->connection = new PDO("mysql:dbname={$connectionParams['db']};host={$connectionParams['host']}", $connectionParams['username'], $connectionParams['password']);

			$this->execQuery("SET NAMES UTF-8");
		}
		/**
		 * 
		 * Enter description here ...
		 * @return PDOStatement
		 */
		public function execQuery($query){
			$statement = $this->connection->prepare($query);
			
			$statement->execute();
			return $statement;
		}
		
		public function getNumberAffectedRows(PDOStatement $resource){
			return $resource->rowCount();
		}
		
		public function fetch($query){
			$statement = $this->execQuery($query);
			return $statement->fetch(PDO::FETCH_ASSOC);
		}
		
		public function fetchColumn($query,$columnIndex=1){
			$statement = $this->execQuery($query);
			return $statement->fetchAll(PDO::FETCH_COLUMN,$columnIndex);
		}
		
		public function fetchAll($query){
			$statement = $this->execQuery($query);
			return $statement->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public function escape($data){
			return addslashes($data);
		}
		
		public function startTransaction(){
			$this->connection->beginTransaction();
		}
		
		public function commitTransaction(){
			$this->connection->commit();
		}
		
		public function rollbackTransaction(){
			$this->connection->rollBack();
		}
	}