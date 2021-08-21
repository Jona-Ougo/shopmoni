<div class="inbox-widget slimscroll-alt mx-box">
	<?php foreach($conversations as $row): ?>
		<a href="javascript:void(0);" onclick="loadChat('<?=$row->id ?>')">

			<div class="inbox-item">
				<p class="inbox-item-author"><?=$row->sender_name ?></p>
				<p class="inbox-item-text"><?=$row->sender_email ?></p>
				<p class="inbox-item-date"><?=$row->messages ?></p>
			</div>
		</a>
	<?php endforeach ?>
</div>