<div class="row">
	<div class="row">

		<div class="col-lg-4">
			<div class="card-box">
				<h4 class="m-t-0 m-b-20 header-title"><b>Conversations</b></h4>
				<div id="conversations" style="overflow:auto"><?=$conversations; ?></div>
			</div>
		</div>

		<div class="col-lg-8">
			<div class="card-box">
				<h4 class="m-t-0 m-b-20 header-title"><b id="name">Chat</b></h4>

				<div class="chat-conversation">
					<div class="sk-wave">
						<div class="sk-rect sk-rect1"></div>
						<div class="sk-rect sk-rect2"></div>
						<div class="sk-rect sk-rect3"></div>
						<div class="sk-rect sk-rect4"></div>
						<div class="sk-rect sk-rect5"></div>
					</div>
					<ul class="conversation-list slimscroll-alt" style="height: 380px; min-height: 332px;">
					</ul>
					<div class="row">
						<div class="col-sm-9 chat-inputbar">
							<input type="text" class="form-control chat-input" placeholder="Enter your text" id="messagebox">
						</div>
						<input type="hidden" name="conversation_id" id="chat_conversation_id" value="0">
						<div class="col-sm-3 chat-send">
							<button type="submit" id="send" class="btn btn-md btn-info btn-block waves-effect waves-light" onclick="send()">Send</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<script>

	let baseUrl 	= '<?=site_url() ?>';
	let url 		= '<?=site_url('chat') ?>/';
</script>
<script src="<?=base_url('assets/js/customerchat.js') ?>" type="text/javascript"></script>