<div class="row">
	<div class="col-sm-6">
		<?=form_open('login/'.$redirect, 'id="loginForm"') ?>
		<div class="box-border">
			<h1><?=lang('login') ?></h1>
			<?php //print_r($loginErrors) ?>
			<?php if(form_error('lpassword') != ''): ?>
				<p style="color:red"><?=form_error('lpassword') ?></p>
			<?php endif; ?>
			<?php if(\CI::session()->flashdata('logout') != ''): ?>
				<p style="color:green"><?=\CI::session()->flashdata('logout') ?></p>
			<?php endif; ?>
			<p>
				<label><?=lang('email') ?>*</label>
				<input type="text" name="lemail" required>
				<span class="text-error" style="color:red"><?=form_error('lemail') ?></span>
			</p>
			<p>
				<label><?=lang('password') ?>*</label>
				<input type="password" name="lpassword" required>
			</p>
			<p>
				<a href="<?=site_url('forgot-password') ?>"><?=lang('forgot_password') ?></a>
			</p>
			<p>
				<input type="checkbox" name="remember" checked>
				<?=lang('keep_me_logged_in') ?>
			</p>
			<p>
				<?=\CI::recaptcha()->getWidget() ?>
				<?=\CI::recaptcha()->getScriptTag() ?>
			</p>
			<p>
				<button class="button" type="submit"><i class="fa fa-lock"></i> 
					<?=lang('form_login') ?>
				</button>
				
			</p>
			<?php if(\CI::uri()->segment(1) == 'checkout' && \CI::uri()->segment(2) == 'login'): ?>
				<p>
					<a class="sv-btn-default" href="<?=site_url('checkout/address-stage') ?>">
						<i class="fa fa-handshake-o"></i>  
						Continue as a guest
					</a>
				</p>
				<input type="hidden" name="checkout_redirect" value="checkout/address-stage">
			<?php endif; ?>

			<?php 
			$banners 	= [];
			$today 		= date('Y-m-d H:i:s');
			if($loginBanner = \DB\DB::getRow('banner_collections', ['code'=>LOGIN_BANNER])){
				$query 		= \CI::db()->where('banner_collection_id', $loginBanner->banner_collection_id);
				$query 		= \CI::db()->where('enable_date <=', $today);
				$query 		= \CI::db()->where('disable_date >=', $today);
				$query 	= \CI::db()->get('banners');
				$banners 	= $query->result();
			}
			?>
			<br>
			<div class="row owl">
				<?php foreach($banners as $row): ?>
					<div class="item">
						<?php $blank = $row->new_window == 1 ? 'target="_blank"' : '' ?>
						<a href="<?=$row->link ?>" <?=$blank ?>>
							<img src="<?=base_url('uploads/'.$row->image) ?>" alt="<?=$row->name ?>">
						</a>
					</div>
					<div class="item">
						<?php $blank = $row->new_window == 1 ? 'target="_blank"' : '' ?>
						<a href="<?=$row->link ?>" <?=$blank ?>>
							<img src="<?=base_url('uploads/'.$row->image) ?>" alt="<?=$row->name ?>">
						</a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?=form_close() ?>
	</div>
	<div class="col-sm-6">
		<?=form_open('register', 'id="registration_form"') ?>
		<input type="hidden" name="submitted" value="submitted" />
		<input type="hidden" name="redirect" value="<?=$redirect; ?>" />
		<div class="box-border">
			<h1>Register. <span style="color:green">it's Free!</span></h1>
			<small>Please enter a valid email address.</small>
			<p>
				<label><?=lang('account_email') ?>*</label>
				<input type="email" name="email" value="<?=set_value('email') ?>" onchange="checkemail()" id="register_email" required>
				<span class="text-error" id="register_email_error"><?=form_error('email') ?></span>
			</p>
			<style type="text/css" media="screen">
			.telin
			{
				width: 500px;					
			}

			.telin .phone
			{
				width: 100px;
				display: inline-block;

			}

			.telin .phoneaft
			{
				width: 380px;
				display: inline-block;
				border-left: none;
			}

			@media screen and (max-width: 320px)
			{
				.telin
				{
					width: 320px;
				}

				.telin .phoneaft
				{
					width: 150px;
				}
			}

			@media screen and (max-width: 375px)
			{
				.telin
				{
					width: 375px;
				}

				.telin .phoneaft
				{
					width: 200px;
				}
			}

			@media screen and (max-width: 425px)
			{
				.telin
				{
					width: 425px;
				}

				.telin .phoneaft
				{
					width: 250px;
				}
			}

			@media screen and (max-width: 768px)
			{
				.telin
				{
					width: 320px;
				}

				.telin .phoneaft
				{
					width: 210px;
				}
			}

			@media screen and (max-width: 1024px)
			{
				.telin
				{
					width: 500px;
				}

				.telin .phoneaft
				{
					width: 340px;
				}
			}
		</style>
		<p class="telin">
			<label><?=lang('account_phone') ?>*</label><br>
			<input type="text" name="phonepref" class="phone" value=""><input type="text" name="phone" value="<?=set_value('phone') ?>" style="" class="phoneaft" onchange="checkphone()" required>
			<br>
			<span class="text-error" id="register_phone_error"><?=form_error('phone') ?></span>
		</p>
		<p>
			<label><?=lang('account_firstname') ?>*</label>
			<input type="text" name="firstname" value="<?=set_value('firstname') ?>" class="has-error" required>
			<span class="text-error"><?=form_error('firstname') ?></span>
		</p>
		<p>
			<label><?=lang('account_lastname') ?>*</label>
			<input type="text" name="lastname" value="<?=set_value('lastname') ?>" required>
			<span class="text-error" ><?=form_error('lastname') ?></span>
		</p>
		<p>
			<label><?=lang('account_password') ?>*</label>
			<input type="password" name="password" value="<?=set_value('password') ?>" autocomplete="off" id="rpassword" onchange="" required>
			<span class="text-error" ><?=form_error('password') ?></span>
		</p>
		<p>
			<label><?=lang('account_confirm') ?>*</label>
			<input type="password" name="confirm" value="<?=set_value('confirm') ?>" autocomplete="off" id="rcpassword" onchange="" required>
			<span class="text-error" id="rcpassword_error"><?=form_error('confirm') ?></span>
		</p>
		<p>
			<label>Country*</label>
			<?php 
				$countries 	= \CI::Locations()->get_countries_menu();
				$data[0] 	= "Select Country";
				$all 		= array_merge($data,$countries);
				
			 ?>
			<?=form_dropdown('country_id', $all, '','id="country_id" required');?> 
			<!-- assign_value('country_id', '156'), --> 
		</p>
		<p>
			<input type="checkbox" name="email_subscribe" value="1" checked="checked">
			<?=lang('account_newsletter_subscribe') ?>
		</p>
		<p>
			<?=form_checkbox('terms_condition', '1', set_checkbox('terms_condition', '1')) ?>
			You agree to our terms and conditions* <br />
			<span class="text-error" ><?=form_error('terms_condition') ?></span>
		</p>
		<p>
			<button class="button" type="submit"><i class="fa fa-user"></i> 
				<?=lang('form_register') ?>
			</button>
		</p>
	</div>
	<?=form_close()?>
</div>

</div>
<script>
	function checkemail()
	{
		email = $('#register_email').val();
		url = "<?=site_url('verify_email') ?>"
		data = {'email':email};
		$.post(url, data, function(response){
			console.log(response)
			if(response == 1){
				$('#register_email_error').html('The requested email is already in use');
			}else{
				$('#register_email_error').html('');
			}
		})
	}

	function checkphone()
	{
		phone = $('#register_phone').val();
		url = "<?=site_url('verify_phone') ?>"
		data = {'phone' : phone}
		$.post(url, data, function(response){

			if(response == 1){

				$('#register_phone_error').html('Phone Number is already in use');
			}else{

				$('#register_phone_error').html('');
			}
		});
	}

	function check_password()
	{
		password = $('#rpassword').val();
		cpassword = $('#rcpassword').val();

		if(password != '' && cpassword != '')
		{
			if(password != cpassword){
				$('#rcpassword_error').html('The confirm password field does not match the password field');
			}else{
				$('#rcpassword_error').html('');
			}
		}
	}
</script>