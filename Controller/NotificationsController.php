<?php


class NotificationsController extends NotificationsAppController {
	
	public $uses = array('Notifications.Notification');
	
	public function dashboard() {
		$this->redirect('admin');
		App::uses('NotificationsEvents', 'Notification.Event');
		$Notifications = new NotificationsEvents();
		$events = array();
		foreach (array_keys($Notifications->implementedEvents()) as $name) {
			$events[$name] = ucwords(str_replace('.', ' ', $name));
		}
		
		$this->set('events', $events);
	}
	
	public function edit_notification($name) {
		$this->redirect('admin');
		$this->set('event_name', $name);
		
		if($this->request->is('get')) {
			if($data = $this->Notification->findByName($name)) {
				$this->request->data = $data;
			}
		}
		
		if($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['Notification']['name'] = $name;
			if($this->Notification->save($this->request->data)) {
				$this->Session->setFlash("Notification Saved");
				$this->redirect(array('action' => 'notifications'));
			}else {
				$this->Session->setFlash('Notification Not Saved!');
			}
		}
	}
	
}
