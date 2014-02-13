<?php
	namespace Mvc\Db;

	use Mvc\Model\DataMapper;
	
	class DbTable{
		protected $primary_key = "";
		protected $table_name = "";
		
		protected $joins = array();
		
		protected function constructSelect($where=array('1=1')){
			$select = "SELECT * FROM ";
			$select .= $this->table_name;
			$select .= " " .join(' ', $this->joins);
			$select .= " WHERE " . join(' AND ',$where);
			
			return $select;
		}
		
		public function join($table, $type="LEFT", $condition = ''){
			if(empty($condition)){
				$condition = "USING({$this->primary_key})";
			}
			
			$this->joins[] = " {$type} JOIN {$table} {$condition}";
			
			return $this;
		}
		
		protected function constructInsert($data){
			$insert = "INSERT INTO ";
			$insert .=$this->table_name;
			$insert .=" SET ";
			$insert .= join(",", $this->constructSetData($data));
			return $insert;
		}
		
		public function describe(){
			$query = "DESCRIBE {$this->table_name}";
			$fields = DataConnection::getInstance()->fetchColumn($query,0);
			return $fields;
		}
		
		public function bindInputData(){
			$dataMapper = new DataMapper($this);
			$inputParams = $dataMapper->getInputData();
			return $inputParams;
		}
		
		protected function constructSetData($data){
			$insert_dirs = array();
			foreach($data as $column => $value){
				$insert_dirs[] = $column . " = '".DataConnection::escapeData($value)."'";
			}
			
			return $insert_dirs;
		}

		protected function constructUpdate($data, $id){
			$update = "UPDATE ";
			$update .=$this->table_name;
			$update .= " SET ";
			$update .= join(",", $this->constructSetData($data));
			
			$update .= " WHERE ";
			$update .= $this->primary_key . "='" . $id . "'";
			
			return $update;
		}
		
		protected function constructDelete($id){
			$delete = "DELETE FROM ";
			$delete .=$this->table_name;
			$delete .= " WHERE  ";
			$delete .= $this->primary_key . "='" . $id . "'";
			
			return $delete;
		}
		
		public function get($id){
			return DataConnection::getInstance()->fetch($this->constructSelect(array($this->primary_key . "='" . $id . "'")));			
		}
		
		public function delete($id){
			DataConnection::getInstance()->execQuery($this->constructDelete($id));
		}
		
		public function select($filter=array("1=1")){
			return DataConnection::getInstance()->fetchAll($this->constructSelect($filter));
		}
		
		public function getPk(){
			return $this->primary_key;
		}
		
		public function save($data, $id=null, $push = false){
			if($id == null){
				unset($data[$this->primary_key]);
				$query = $this->constructInsert($data);
			} else {
				unset($data[$this->primary_key]);
				$query = $this->constructUpdate($data, $id);
			}
			
			if($push){
				$data[$this->primary_key] = $id;
				$query = $this->constructInsert($data);
			}
			$resource = DataConnection::getInstance()->execQuery($query);
			if(DataConnection::getInstance()->getNumberAffectedRows($resource) == 1){
				return true;
			} else {
				return false;
			}
		}
	}