<?php
namespace Form\Widget;

class SelectWidget implements Widget{
	private $options = array();
	public function __construct($options){
		$this->options = $options;
	}
	
	public function render($name, $data){
		echo "<select name='$name'>". $this->renderOptions($data) ."</select>";
	}
	
	public function renderOptions($selected){
		$options = "";
		foreach($this->options as $optionValue => $text){
			$isSelected = "";
			if($selected == $optionValue){
				$isSelected = 'selected';
			}
			
			 $options .="<option value=\"$optionValue\" $isSelected>{$text}</option>";
		}
		
		return $options;
	}
}