<div id="<?php echo $this->params['action']; ?>">
	<?php echo $this->Form->create(); ?>
	<?php echo $this->Form->input('Notification.id'); ?>
	<?php echo $this->Form->input('Notification.name'); ?>
	<?php echo $this->Form->input('Notification.subject'); ?>
	<?php echo $this->Form->input('Notification.email_to', array('label' => 'Enter list of to emails seperated by a comma')); ?>
	<?php echo $this->Form->input('Notification.email_cc', array('label' => 'Enter list of CC emails seperated by a comma')); ?>
	<?php echo $this->Form->input('Notification.email_bcc', array('label' => 'Enter list of BCC emails seperated by a comma')); ?>
	<?php echo $this->Form->input('Notification.enabled'); ?>
	<?php echo $this->Form->input('Notification.template', array('type' => 'richtext')); ?>
	<fieldset>
		<legend class="toggleClick"><?php echo __('Available Tokens');?></legend>
		<div id="tokenChoices">
    		<?php echo $this->Html->nestedList($tokens, array('class'=>'token-list'), array('class'=>'token-item')); ?>
    	</div>
    </fieldset>
	<?php echo $this->Form->end('Save'); ?>
	

</div>

<?php $this->Html->script('/Notifications/js/tokens', array('inline' => false)); ?>