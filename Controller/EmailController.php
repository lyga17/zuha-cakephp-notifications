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
		$this->view = "order_complete_email";
		$this->set('order', $order);
		
	}
	
	protected function _sendUserRegisterEmail($data) {
		$this->view = "user_registration_email"; 
		$this->set('user', $data[$data['Model']->alias]);
	}
	
}
