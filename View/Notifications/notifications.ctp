<div id="Notifications">
	
	<table>
		<thead>
			<tr>
				<th>Event Name</th>
				<th>Enabled</th>
				<th>Actions</th>
			</tr>
		</thead>
		
		<tbody>
			<?php foreach($events as $name => $event) { ?>
				<tr>
					<td><?php echo $event; ?></td>
					<td>Not Created</td>
					<td>
						<?php echo $this->Html->link('Edit', array('action' => 'edit_notification', $name)); ?>
					</td>
				</tr>
			<?php }; ?>
		</tbody>
		
	</table>
</div>
