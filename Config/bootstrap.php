<?php
// In any configuration file or piece of code that executes before the event
App::uses('CakeEventManager', 'Event');

// Attach the NotificationsEvents object to the global event manager
// @todo Something about Zuha Loading System does not allow App::uses

require_once APP.DS.'Plugin'.DS.'Notifications'.DS.'Event'.DS.'NotificationsEventListener.php';
$notifications = new NotificationsEvents;
CakeEventManager::instance()->attach($notifications);