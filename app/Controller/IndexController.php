<?php
	namespace App\Controller;
	
	use Mvc\Model\ViewModel;

	use Mvc\Controller\BaseController;

	class IndexController extends BaseController{
		public function indexAction(){
			return new ViewModel(array(
				'a' => "It works!"
			));
		}
	}