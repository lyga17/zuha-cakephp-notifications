<?php

App::uses('AppController', 'Notifications.Controller');

/**
 * Emails Controller.
 * 
 * This is an overridable Controller that is used for sending out
 * Notification emails. We use a controller here so we have access
 * to rendering views.
 * 
 *  
 * @author Nick Lyga
 *
 */

class EmailAbstractController extends AppController {
	
	public $viewClass = 'TwigView.TwigEmail';
	public $view = false;
		
	public $ext = ".tpl";
	
	protected $_eventName = ""; //holder for the event name
	
	protected $_event = false; //holder for the Event
	
	protected $_data = false; //holder for notification data;
	
	protected $_body = ""; //Holder for the message body
	
	
	
	public function __construct($request = null, $response = null) {
		parent::__construct($request, $response);
		//This is because it always needed, and it shouldn't be overridable
		$this->loadModel('Notifications.Notification');
	}
	
	
	
	/**
	 * Overloading the method calls to provide callbacks on
	 * Methods. This is being used because the controller does
	 * not get used like a typical controller. Fails silently
	 * if method is not defined.
	 * 
	 * @param string $name
	 * @param mixed $arguments
	 * @return boolean
	 */
	
	public function __call($name, $arguments) {
		$name = "_send".$name;
		if(method_exists($this, $name)) {
			//call init function to setup needed data
			if(!$this->_init()) {
				debug('here');exit;
				return false;
			}
			$this->$name($arguments[0]);
			$this->_body = $this->render();
			return $this->send();
		}else {
			return false;
		}
	}
	
	/**
	 * Init Method, sets up notification this gets called before event methods.
	 *
	 * @throws Exception
	 */
	
	public function _init() {
		$this->_data = $this->Notification->find('first', array('event_name' => $this->_eventName));
		//No data defined just return false
		if($this->_data === false) {
			return false;
		}
		return true;
	}
	
	
	/**
	 * Overriding the render method - There is not request/response objects
	 * available. Returns Rendered HTML for sending Emails
	 * @see Controller::render()
	 */
	public function render($view = null, $layout = null) {
		$this->View = $this->_getViewObject();
		$this->autoRender = false;
		if($view === null) {
			$view = isset($this->view) ? $this->view : "default";
		}
		if($layout === null) {
			$layout = isset($this->layout) ? $this->layout : "default";
		}
		return $this->View->renderHtml();
	}
	
	protected function _getTemplateFromFile($filename) {
		return file_get_contents(ROOT.DS.APP_DIR.DS."Plugin".DS."Notifications".DS."View".DS."Emails".DS.$filename.".tpl");
	}
	
	/**
	 * Exposes send method
	 */
	public function send() {
		$this->_send();
	}
	
	
	/**
	 * _send Method uses AppController __sendMail()
	 * 
	 * @see AppController::__sendMail
	 */
	private function _send() {
		$toEmail = $this->_data['Notification']['email_to'];
		$subject = $this->_data['Notification']['subject'];
		$message = $this->_body;
		$this->__sendMail($toEmail, $subject, $message, $template = 'default', $from = array(), $attachment = array());		
	}
}
