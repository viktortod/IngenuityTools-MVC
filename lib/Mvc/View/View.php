<?php
	namespace Mvc\View;
	
	use Form\Generator;

	class View {
		private $layout;
		
		private $content;
		private $template;
		
		private $set;
		
		private $generator;
		
		public function __construct($template, $parseLayout){
			$this->template = $template;
			$this->layout = $parseLayout;
//			$this->generator = new Generator();
			$this->set = array();
		}
		
		public function set($values){
			$this->set = $values;
		}
		
		public function block($blockName){
			$blockClassName = "App\\Block\\" . ucfirst($blockName);
			
			if(class_exists($blockClassName)){
				$instance = new $blockClassName($blockClassName, array());
				$instance->execute();
				
				$instance->showBlock();
			}
		}
		
		public function layout($layoutName){
			$blocks = Layout::getInstance()->getLayoutBlocks($layoutName);
			
			// dump($blocks)s;
			foreach($blocks as $block){
				if($block['block_is_static_text']){
					echo $block['block_content'];
				}
				else {
					echo $this->block($block['block_name']);
				}
				
			}
		}
		
		public function show(){
			$this->content = $this->parse($this->template);
			
			echo $this->parse($this->layout);
		}
		
		public function css($name){
			$src = APP_MAIN_URL."layout/css/" . $name;
			
			return '<link rel="stylesheet" type="text/css" href="'.$src.'" media="screen" />';
		}
		
		public function js($name){
			$href = APP_MAIN_URL."layout/js/" . $name;
			
			return '<script type="text/javascript" src="'.$href.'"></script>';
		}
		
		// public function getForm(){
			// return $this->generator;
		// }
		
		public function parse($template){
			foreach($this->set as $param =>$value){
				${$param} = $value;
			}	
			
			ob_start();
			require $template;
			return ob_get_clean();
		}
	}