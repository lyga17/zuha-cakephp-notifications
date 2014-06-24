<?php
App::uses('EmailController', 'Notifications.Controller');
App::uses("CakeResponse", "Cake.Network");

class TestEmailsController extends EmailController {
	
	
	public function redirect($url, $status=null, $exit=true) {
		return $url;
	}
	
	/**
	 * Returns a send array for testing
	 */
	public function send() {
		return array(
		 	'toEmail' => $this->_data['Notification']['email_to'],
			'subject' => $this->_data['Notification']['subject'],
			'message' => $this->_body,
		);
	}
	
}


class EmailsAppControllerTest extends ControllerTestCase {
	public $fixtures = array('app.Alias', 'app.CakeSession', 'plugin.Users.User', 'plugin.Notifications.Notification');

	public function setUp() {
        parent::setUp();
        CakePlugin::load("TwigView");
       	$this->Emails = new TestEmailsController();
       	$this->Emails->response = new CakeResponse();
    }
    
    public function tearDown() {
    	unset($this->Emails);
    	ClassRegistry::flush();
    	parent::tearDown();
    }

	public function testuserRegisterEmail() {
		$this->Emails->loadModel("User", "Users.Model");
		$user = $this->Emails->User->findById(100);
		//Fake Event Data
		$event = array('Model' => $this->Emails->User, $this->Emails->User->alias => $user['User']);
		$this->Emails->_eventName = "Model.User.created";
		//This would be the same call the event makes
		$result = $this->Emails->UserRegisterEmail($event);
		//Get data for checking result
		$this->Emails->Notification->create();
		$notification = $this->Emails->Notification->findById('5077241d-9040-43c9-85b1-22d40000000');
		//check to
		$this->assertEqual($result['toEmail'], $notification['Notification']['email_to']);
		//check subject
		$this->assertEqual($result['subject'], $notification['Notification']['subject']);
		//check template rendered properly
		$this->assertTextContains($user['User']['username'], $result['message']);
	}
}