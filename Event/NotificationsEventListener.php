<?php
App::uses('CakeEventListener', 'Event');
App::uses('EmailsController', 'Notifications.Controller');

class NotificationsEvents implements CakeEventListener {
	
	private $_controller; //Holder for Controller Class
	
	public function __construct() {
		$this->_controller = new EmailsController();
	}
	
	
	/**
	 * Implemented Events
	 * 
	 * Events Should be in the Format 
	 * 
	 * [TYPE].[NAME].[event]
	 * 
	 * This is required for path lookups
	 * 
	 * @see CakeEventListener::implementedEvents()
	 */
	
	
	public function implementedEvents() {
		return 
			array(
				'Model.Transaction.complete' => array(
	                'callable' => 'sendOrderCompleteEmail',
	                'passParams' => true
            	),
			);
	}

 	public function __call($name, $arguments) {
        //Call the method on the bound controller
        if(method_exists($this->_controller, $name)) {
        	call_user_method_array($name, $this->_controller, $arguments);
        }else {
        	throw new Exception("{$name} method does not exist on {$this->_conroller->name}");
        }
    }
}