<?php
App::uses('CakeEventListener', 'Event');

class NotificationsEvents implements CakeEventListener {
	
	private $_controller; //Holder for Controller Class
	
	
	/**
	 * Construct Method
	 * @param array $options
	 * 
	 * Options = array(
	 * 		controller => "[PluginName].[ControllerClassName]"
	 * )
	 * 
	 */
	public function __construct($options = array()) {
		if(!isset($options['controller'])) {
			$options['controller'] = "Notifications.EmailsAppController";
		}
		$split = explode(".", $options['controller']);
		App::uses($split[1], "{$split[0]}.Controller");
		$this->_controller = new $split[1]();
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
        //Call the method on the bound controller
        $this->_controller->_event = $this;
        $this->_controller->_eventName = $this->_getEventName($name);
        $this->_controller->$name($arguments);
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