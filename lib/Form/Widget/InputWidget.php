<?php
	namespace Form\Widget;
	
	class InputWidget implements Widget {
		protected $type = "text";
		
		public function render($name, $data){
			echo "<input type='text' name='{$name}' value='{$data}' />";
		}
	}