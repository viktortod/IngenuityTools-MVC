<?php
	namespace Form\Widget;
	
	class DynRowsWidget extends FormWidget{
		protected $widgetTemplateFile = "dyn_row/index.tmp";
		
		protected $widgetHeadersTemplate = "dyn_row/headers.tmp";
		protected $widgetLinesTemplate = "dyn_row/line.tmp";
		
		protected $definition;
		
		public function render($name, $data){
			$this->definition = $data;
			$definition = $this->definition->getOptions();
			$definition['name'] = $name;
			$definition['headers'] = $this->parseTemplate($definition, $this->widgetHeadersTemplate);
			
			$info = array();
			foreach($definition['info'] as $line){
				$info[] = $this->parseTemplate(array("line" => $line,'columns'=>$definition['columns'],'operations'=>$definition['operations']),$this->widgetLinesTemplate);
			}
			
			$definition['info'] = $info;
			
			$columnsTemplate = array();
			foreach($definition['columns'] as $column => $template_info_column){
				$columnsTemplate[$column] = "";
			}
			
			$definition['info_template'] =  $this->parseTemplate(array("line" => $columnsTemplate,'columns'=>$definition['columns'],'operations'=>$definition['operations']),$this->widgetLinesTemplate);
			echo $this->parseTemplate($definition);
		}
		
		public function getWidget($column){
			return $this->definition->getWidget($column);
		}
	}