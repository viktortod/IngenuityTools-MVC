<?php
	namespace Form\Widget;
	
	class InputTextWidget implements Widget {
		public function render($name, $data){
			echo "<textarea>{$data}</textarea>";
		}
	}