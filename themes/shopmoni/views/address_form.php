
<?=form_open('addresses/form/'.$id, ['id'=>'addressForm']) ?>
<div class="order-detail-content table-responsive">
	<div class="cart_summary table" style="overflow-x:hidden !important">

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="firstname"><?=lang('address_firstname') ?></label>
					<?=form_input(['name'=>'firstname', 'value'=>assign_value('firstname', $firstname), 'class'=>'form-control']) ?>
					<span class="form-error" style="color:red"><?=form_error('firstname') ?></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="lastname"><?=lang('address_lastname') ?></label>
					<?=form_input(['name'=>'lastname', 'value'=>assign_value('lastname', $lastname), 'class'=>'form-control']) ?>
					<span class="form-error" style="color:red"><?=form_error('lastname') ?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="email"><?=lang('address_email') ?></label>
				<?=form_input(['name'=>'email', 'value'=>assign_value('email', $email),'class'=>'form-control']) ?>
				<span class="form-error" style="color:red"><?=form_error('email') ?></span>
			</div>
			<div class="col-md-6">
				<label for="phone"><?=lang('address_phone') ?></label>
				<?=form_input(['name'=>'phone', 'value'=>assign_value('phone', $phone),'class'=>'form-control']) ?>
				<span class="form-error" style="color:red"><?=form_error('phone') ?></span>
			</div>
		</div>

		<div class="form-group">
			<label for="address1">Address Line One</label>
			<?=form_input(['name'=>'address1','value'=>assign_value('address1', $address1),'class'=>'form-control']) ?>
			<span class="form-error" style="color:red"><?=form_error('address1') ?></span>
		</div>
		<div class="form-group">
			<label for="address1">Address Line Two</label>
			<?=form_input(['name'=>'address2','value'=>assign_value('address2', $address2),'class'=>'form-control']) ?>
			<span class="form-error" style="color:red"><?=form_error('address2') ?></span>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="country_id">Country</label>
					<?=form_dropdown('country_id', $countries_menu, assign_value('country_id', $country_id), 'id="country_id" class="form-control"');?>	
					<span class="form-error" style="color:red"><?=form_error('country_id') ?></span>
				</div>
			</div>
			<div class="col-md-3">
				<label for="city"><?=lang('address_city') ?></label>
				<?=form_input(['name'=>'city', 'value'=>assign_value('city',$city), 'class'=>'form-control']);?>
				<span class="form-error" style="color:red"><?=form_error('city') ?></span>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">State</label>
					<?=form_dropdown('zone_id', $zones_menu, assign_value('zone_id', $zone_id), 'id="zone_id" class="form-control"');?>
					<span class="form-error" style="color:red"><?=form_error('zone_id') ?></span>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="form-group">
					<label for="zip">Zip</label>
					<?=form_input(['maxlength'=>'10', 'name'=>'zip', 'value'=> assign_value('zip',$zip), 'class'=>'form-control']);?>
					<span class="form-error" style="color:red"><?=form_error('zip') ?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="cart_navigation">
		<a class="button" href="<?=site_url('checkout') ?>"><i class="fa fa-angle-left"></i> Back To Cart </a>
		<button class="button pull-right" type="submit">
			<?=lang('save_address') ?> 
			<i class="fa fa-angle-right"></i>
		</button>
	</div>
</div>
<?=form_close() ?>

<script> 
	$(function(){
		$('#country_id').change(function(){
			$('#zone_id').load('<?=site_url('addresses/get-zone-options');?>/'+$('#country_id').val());
		});

		function closeAddressForm(){
			$('.checkoutAddress').load('<?=site_url('checkout/address-list');?>');
		}

		$('#addressForm').on('submit', function(event){
			$('.addressFormWrapper').spin();
			event.preventDefault();
			$.post($(this).attr('action'), $(this).serialize(), function(data){
				if(data == 1)
				{
					//closeAddressForm();
					$('.checkoutAddress').load('<?=site_url('checkout/address-list');?>');
				}
				else
				{
					message('error', 'Please fill all fields before submiting.');
				}
			});
		})
	});

	<?php if(validation_errors()):
	$errors = \CI::form_validation()->get_error_array(); ?>

	var formErrors = <?php echo json_encode($errors);?>
	
	for (var key in formErrors) {
		if (formErrors.hasOwnProperty(key)) {
			$('[name="'+key+'"]').parent().append('<span sytle="color:red">'+formErrors[key]+'</span>')
		}
	}
<?php endif;?>
</script>