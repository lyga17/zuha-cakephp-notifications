<?php
/**
 * NotificationFixture
 *
 */
class NotificationFixture extends CakeTestFixture {

/**
 * Import
 *
 * @var array
 */
	public $import = array('config' => 'Notifications.Notification');
	
	
/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '5077241d-9040-43c9-85b1-22d40000000',
			'event_name' => 'Model.User.created',
			'subject' => 'NewUser',
			'email_to' => 'test@example.com',
			'email_cc' => 'textcc@example.com',
			'email_bcc' => 'testbcc@example.com',
			'email_from' => 'from@example.com',
			'template' => '',
			'enabled' => true,
			'settings' => null,
			'creator_id' => '1',
			'modifier_id' => '1',
			'created' => '2012-10-11 19:55:09',
			'modified' => '2012-10-11 19:55:09'
		)
	);
}
