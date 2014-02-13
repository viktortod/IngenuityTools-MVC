<?php
	namespace Mvc\View;
	
	use Mvc\Db\Table\Layout as DbGateway;
	
	class Layout {
		private static $instance = null;
		
		private $layouts;
		
		public static function getInstance(){
			if(self::$instance == null){
				self::$instance = new \Mvc\View\Layout();
			}
			
			return self::$instance;
		}
		
		public function __construct(){
			$db = new DbGateway();
			// dump($db->select());
			$this->layouts = assoc($db->select(array("block_is_active=1")),"layout_name","",true);
			
		}
		
		public function getLayoutBlocks($layoutName){
			if(empty($this->layouts[$layoutName])){
				return array();
			}
			
			$layoutBlocks = $this->layouts[$layoutName];
			
			return $layoutBlocks;
		}
		
	}