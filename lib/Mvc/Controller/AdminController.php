<?php
	namespace Mvc\Controller;
	
	use Table\DataGrid;
	use Mvc\Model\ViewModel;
	use Mvc\Model\RedirectModel;
	use Form\Form;
	
	use Router;
	
	class AdminController extends BaseController {
		protected $db;
		
		protected $gridDefintion;
		
		protected $webFormDefinition;
		
		public function indexAction(){
			$items = $this->db->select();
			
			return new ViewModel(array(
				"dataGrid" => new DataGrid($this->gridDefintion, $items)
			));
		}
		
		public function editAction($id=null){	
			return new ViewModel(array(
				"form" => $this->webFormDefinition,
				"controller" => str_replace("Controller","",get_class($this)),
				"data" => $this->db->get($id),
			));
		}
		
		public function saveAction($id=null){
			$data = $this->db->bindInputData();
			
			$this->db->save($data, $id);
			
			return new RedirectModel(array(
				"controller" => Router::getInstance()->getController(),
				"action" => "index"
			));
		}
		
		public function deleteAction($id){
			$this->db->delete($id);
			
			return new RedirectModel(array(
				"controller" => Router::getInstance()->getController,
				"action" => "index"
			));
		}
	}