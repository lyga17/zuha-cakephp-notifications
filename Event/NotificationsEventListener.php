<?php
App::uses('CakeEventListener', 'Event');


/**
 * Notifications Event Listener
 * 
 * Listens for events for email notifications
 * Called and passes params to email controller.
 * 
 * if you set event['controller'] = "[Plugin].[Controller]"
 * this will init and pass the data to that controller.
 * controller mush implement EmailsControllerAbstract
 * 
 * @author Nick Lyga
 *
 */


class NotificationsEvents implements CakeEventListener {
	
	private $_controller; //Holder for Controller Class
	
	
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
	                'callable' => 'OrderCompleteEmail',
	                'passParams' => true
            	),
				'Model.User.created' => array(
						'callable' => 'UserRegisterEmail',
						'passParams' => true
				),
			);
	}

 	public function __call($name, $arguments) {
 		//Bind Controller
 		$arguments = $this->_bindController($arguments);
        //Call the method on the bound controller
        $this->_controller->_event = $this;
        $this->_controller->_eventName = $this->_getEventName($name);
        $this->_controller->$name($arguments[0], $arguments[1], $arguments[3]);
    }
    
    private function _bindController($arguments) {
    	if(!isset($arguments[3]['controller'])) {
    		$options['controller'] = "Notifications.EmailController";
    	}else {
    		$options['controller'] = $arguments[3]['controller'];
    	}
    	$split = explode(".", $options['controller']);
    	App::uses($split[1], "{$split[0]}.Controller");
    	$this->_controller = new $split[1]();
    	return $arguments;
    }
    
    private function _getEventName($name) {
    	$events = $this->implementedEvents();
    	foreach ($events as $called => $event) {
    		if($event['callable'] === $name) {
    			return $called;
    		}
    	}
    }
}