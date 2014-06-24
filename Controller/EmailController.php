<?php

App::uses('EmailAbstractController', 'Notifications.Lib');

/**
 * Default Emails Controller.
 * 
 * This is an overridable Controller that is used for sending out
 * Notification emails. We use a controller here so we have access
 * to rendering views.
 * 
 * Methods should be protected so they don't appear in ACL
 * 
 *  
 * @author Nick Lyga
 *
 */

class EmailController extends EmailAbstractController {
	
	protected function _sendOrderCompleteEmail($order) {
		$this->set('order', $data[$data['Model']->alias]);
	}
	
	protected function _sendUserRegisterEmail($data) {
		$this->set('user', $data[$data['Model']->alias]);
	}
	
}
