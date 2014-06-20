<div id="<?php echo $this->params['action']; ?>">
	
	<?php echo $this->Form->create(); ?>
	
	<?php if(isset($this->request->data['Notification']['id'])) {
		echo $this->Form->hidden('Notification.id');
	}?>
	
	<?php echo $this->Form->hidden('name', array('value' => $event_name)); ?>
	<?php echo $this->Form->input('Notification.subject'); ?>
	<?php echo $this->Form->input('Notification.email_to', array('label' => 'Enter list of emails seperated by a comma')); ?>
	<?php echo $this->Form->input('Notification.enabled'); ?>
	<?php echo $this->Form->input('Notification.template', array('type' => 'richtext')); ?>
	
	<?php echo $this->Form->end('Save'); ?>

</div>