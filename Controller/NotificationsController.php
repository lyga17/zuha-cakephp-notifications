<?php


class NotificationsController extends NotificationsAppController {
	
	public $uses = array('Notifications.Notification');
	
	public function dashboard() {
		$this->redirect('admin');
		
		if(!$this->request->is('get') && isset($this->request->data['add'])) {
			$this->Notification->save($this->request->data);
			$this->redirect(array('action' => 'dashboard'));
		}
		
		$this->set('notifications', $this->Notification->find('all'));
		
		App::uses('NotificationsEvents', 'Notification.Event');
		$Notifications = new NotificationsEvents();
		$events = array();
		foreach (array_keys($Notifications->implementedEvents()) as $name) {
			$events[$name] = ucwords(str_replace('.', ' ', $name));
		}
		
		$this->set('events', $events);
	}
	
	public function edit_notification($id) {
		$this->redirect('admin');
		
		if($this->request->is('get')) {
			if($data = $this->Notification->findById($id)) {
				$this->request->data = $data;
			}
		}
		
		if($this->request->is('post') || $this->request->is('put')) {
			if($this->Notification->save($this->request->data)) {
				$this->Session->setFlash("Notification Saved");
				$this->redirect(array('action' => 'dashboard'));
			}else {
				$this->Session->setFlash('Notification Not Saved!');
			}
		}
		$event = explode(".", $this->request->data['Notification']['event_name']);
		$this->set('tokens', $this->_buildTokens(array($event[1])));
	}
	
	
	public function delete_notification($id) {
		if($this->request->is('post') || $this->request->is('put')) {
			if($this->Notification->delete($id)) {
				$this->Session->setFlash("Notification Deleted");
			}else {
				$this->Session->setFlash('Notification Not Deleted!');
			}
		}
		$this->redirect(array('action' => 'dashboard'));
	}
	
	public function test_notification($id) {
		if(!$notification = $this->Notification->findById($id)) {
			$this->Session->setFlash("Notification Not Found");
			$this->redirect($this->referer());
		}
		
		$emailto = $this->Session->read('Auth.User.email');
		$subject = $notification['Notification']['subject'];
		$body = $notification['Notification']['template'];
		$this->__sendMail($emailto, $subject, $body);
		$this->Session->setFlash("Test email sent to: {$emailto}");
		$this->redirect(array('action' => 'dashboard'));
	}
	
}
