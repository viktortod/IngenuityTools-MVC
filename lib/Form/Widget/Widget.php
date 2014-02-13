<?php
	namespace Form\Widget;
	
	interface Widget {
		public function render($name, $data);
	}