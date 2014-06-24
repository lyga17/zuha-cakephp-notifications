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

class EmailsAppController extends AppController {
	
	public $viewClass = 'TwigView.TwigEmail';
	public $view = false;
	
	public $uses = array('Notifications.Notification');
	
	public $ext = ".tpl";
	
	protected $_eventName = ""; //holder for the event name
	
	protected $_event = false; //holder for the Event
	
	protected $_data = false; //holder for notification data;
	
	protected $_body = ""; //Holder for the message body
	
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
			$this->_init();
			$this->$name($arguments[0]);
			$this->_body = $this->render();
			return $this->_send();
		}else {
			return false;
		}
	}
	
	/**
	 * Init Method, sets up notification this gets called before
	 * and event methods.
	 *
	 * @throws Exception
	 */
	
	public function _init() {
		$this->_data = $this->Notification->find('first', array('event_name' => $this->_eventName));
		if(!$this->_data) {
			throw new Exception("Notification not defined");
		}
	}
	
	protected function _sendOrderCompleteEmail($order) {
		$this->view = "order_complete_email";
		$this->set('order', $order);
		
	}
	
	protected function _sendUserRegisterEmail($data) {
		$this->view = "user_registration_email"; 
		$this->set('user', $data[$data['Model']->alias]);
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
	 * _send Method uses AppController __sendMail()
	 * 
	 * @see AppController::__sendMail
	 */
	protected function _send() {
		debug($this->_data);exit;
		$toEmail = $this->_data['Notification']['email_to'];
		$subject = $this->_data['Notification']['subject'];
		$message = $this->_body;
		$this->__sendMail($toEmail, $subject, $message, $template = 'default', $from = array(), $attachment = array());		
	}
}
