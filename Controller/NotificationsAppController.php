<?php

App::uses('AppController', 'Controller');

class NotificationsAppController extends AppController {
	
	public $tokens = array();
	
	protected function _buildTokens($models = array(), $assoc = false) {
		foreach($models as $model) {
			App::uses($model, ZuhaInflector::pluginize($model).'.Model');
			$Model = new $model();
			$this->tokens[$Model->name] = array_keys($Model->schema());
			if($assoc) {
				$associated = $Model->listAssociatedModels();
				foreach($associated as $assocModel) {
					$this->tokens[$assocModel] = array_keys($Model->$assocModel->schema());
				}
			}
		}
		return $this->tokens;
	}
	
}
