<div class="row">
	<h2><?=lang('order_history') ?></h2>
	<?php if($orders): ?>
		<?=$orders_pagination; ?>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><?=lang('order_date') ?></th>
					<th><?=lang('order_number') ?></th>
					<th><?=lang('order_status') ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($orders as $order): ?>
					<tr>
						<td>
							<?php
							$d = format_date($order->ordered_on);
							$d = explode(' ', $d);
							echo $d[0].' '.$d[1].', '.$d[3];
							?>
						</td>
						<td>
							<a href="<?=site_url('order-complete/'.$order->order_number) ?>" target="_blank">
								<?=$order->order_number ?>
							</a> 
						</td>
						<td>
							<?=$order->status ?>
						</td>
					</tr>
				<?php endforeach; ?>

			</tbody>
		</table>
	<?php else: ?>
		<div class="alert alert-danger">
			<?=lang('no_order_history') ?>
		</div>
	<?php endif; ?>
</div>