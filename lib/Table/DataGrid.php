<?php
	namespace Table;
	use Router;
	
	class DataGrid {
		protected $definition;
		
		protected $data;
		
		public function __construct($definition, $data){
			$this->data = $data;
			
			$this->definition = $definition;
		}
		
		public function parseTable(){
			$table = "<table>";
			$table .= $this->parseHeaders();		
			$table .= $this->parseData();
			$table .= "</table>";
			
			echo $table;
		}
		
		public function parseHeaders(){
			$columns = $this->definition->getColumns();
						
			$content = "<tr>";
			
			$columns[] = "";
			foreach($columns as $column){
				$content .= "<th>{$column}</th>";
			}
			
			$content .= "</tr>";
			
			return $content;
		}
		
		private function getColumnValue($field, $value){
			return $this->definition->get($field,$value);
		}
		
		public function parseData(){
			$rows = array();
			$columns = $this->definition->getColumns();

			
			
			foreach($this->data as $dataRow){
				$operations = $this->definition->getOperations($dataRow);
				$content = "<tr>";

				foreach($columns as $field => $column){
					$element = $this->getColumnValue($field, $dataRow[$field]);
					$content .= @"<td>{$element}</td>";
				}				
				
				$content .= "<td>";
				foreach($operations as $operation){
					
					
					$content .= $operation;
				}
				$content .= "</td>";
				$content .= "</tr>";
				
				$rows[] = $content;
			}
			
			return join(" ", $rows);
		}
	}