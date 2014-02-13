<?php
	namespace Form\Widget;
	
	class DynRowDefinition {
		protected $columns;
		protected $widgets;
		
		protected $info;
		
		protected $operations;
		
		protected $editForm =array();
		
		public function __construct($columns, $operations, $info){
			$this->columns = $columns;
			$this->info = $info;
			$this->operations = $operations;
		}
		
		public function addEditWidget($key , $widget){
			$this->editForm[$key] = $widget;
		}
		
		public function getOptions(){
			return array(
				'columns' => $this->columns,
				'operations' => $this->operations,
				'info' => $this->info,
				'editForm' => $this->editForm
			);
		}
	}
	