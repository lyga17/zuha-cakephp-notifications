<?php 
class NotificationsSchema extends CakeSchema {

	public $renames = array();

	public function __construct($options = array()) {
		parent::__construct();
	}
	
	public function before($event = array()) {
		App::uses('UpdateSchema', 'Model'); 
		$this->UpdateSchema = new UpdateSchema;
		$before = $this->UpdateSchema->before($event);
		return $before;
	}

	public function after($event = array()) {
		$this->UpdateSchema->rename($event, $this->renames);
		$this->UpdateSchema->after($event);
	}

	
	public $notifications = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'auto' => true, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'event_name' => array('type' => 'string', 'null' => false, 'length' => 150, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 150, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'subject' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email_to' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 255, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email_cc' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 255, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email_bcc' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 255, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email_from' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 255, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'template' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'comment' => 'Template for Email', 'charset' => 'utf8'),
		'enabled' => array('type' => 'boolean', 'default' => true),
		'settings' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'modifier_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'creator_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);
	
}
