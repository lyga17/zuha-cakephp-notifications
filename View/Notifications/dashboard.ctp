<div id="Notifications">
	<h1>Edit Site Email Notifications</h1>
	<p>Choose an available event to create a email notification, you can have more than on email per event</p>
	<?php echo $this->Form->create('Notification'); ?>
		<div class="row">
		<div class="col-sm-3">
		<?php echo $this->Form->input('name', array(
			'label' => 'User Friendly Name',
			'required' => 'required',
		)); ?>
		</div>
		<div class="col-sm-3">
		<?php echo $this->Form->input('event_name', array('type' => 'select', 'options' => $events, 'empty' => '-- Select --')); ?>
		</div>
		<div class="col-sm-3" style="padding-top: 27px;">
		<?php echo $this->Form->submit('Add', array('name' => 'add')); ?>
		</div>
		</div>
	<?php echo $this->Form->end(); ?>
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Event Name</th>
				<th>Enabled</th>
				<th>Actions</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($notifications as $notification) { ?>
				<tr>
					<td><?php echo $notification['Notification']['name']; ?></td>
					<td><?php echo $events[$notification['Notification']['event_name']]; ?></td>
					<td><?php if($notification['Notification']['enabled']) { ?>
							<span class="label label-success">Enabled</span>
						<?php } else { ?>
							<span class="label label-warning">Disabled</span>
						<?php } ?>
					</td>
					<td>
						<?php echo $this->Html->link('Edit', array('action' => 'edit_notification', $notification['Notification']['id'])); ?>
						<?php echo $this->Form->postLink('Delete', array('action' => 'delete_notification', $notification['Notification']['id'])); ?>
						<?php echo $this->Html->link('Test', array('action' => 'test_notification', $notification['Notification']['id'])); ?>
					</td>
				</tr>
			<?php }; ?>
		</tbody>
		
	</table>
</div>
