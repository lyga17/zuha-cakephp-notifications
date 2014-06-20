<?php

App::uses('NotificationsAppController', 'Notifications.Controller');

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

class EmailsController extends NotificationsAppController {
	
	public $viewClass = 'TwigView.TwigEmail';
	public $view = false;
	
	public function sendOrderCompleteEmail($order) {
		//debug($this->view);exit;
		$this->_setTemplate("send_order_complete_email");
		$this->set('order', $order);
		debug($this->render());exit;
	}
	
	/**
	 * Overriding the render method - There is not request/response objects
	 * available. Returns Rendered HTML Form sending Emails
	 * @see Controller::render()
	 */
	public function render($view = null, $layout = null) {
		$this->View = $this->_getViewObject();
		$this->autoRender = false;
		return $this->View->renderHtml($view, $layout);
	}
	
	protected function _setTemplate($filename) {
		$this->view = DS."Notifications".DS."View".DS."Emails".DS.$filename;
	}
	
}
