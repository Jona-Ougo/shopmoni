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
<?=form_open('addresses/address-form/'.$id, ['id'=>'addressForm']) ?>
<div class="order-detail-content table-responsive">
	<div class="cart_summary table" style="overflow-x:hidden !important">

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="firstname"><?=lang('address_firstname') ?>*</label>
					<?=form_input(['name'=>'firstname', 'value'=>assign_value('firstname', $firstname)]) ?>
					<span class="form-error" style="color:red"><?=form_error('firstname') ?></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="lastname"><?=lang('address_lastname') ?>*</label>
					<?=form_input(['name'=>'lastname', 'value'=>assign_value('lastname', $lastname)]) ?>
					<span class="form-error" style="color:red"><?=form_error('lastname') ?></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<label for="email"><?=lang('address_email') ?>*</label>
				<?=form_input(['name'=>'email', 'value'=>assign_value('email', $email)]) ?>
				<span class="form-error" style="color:red"><?=form_error('email') ?></span>
			</div>
			<div class="col-md-6">
				<p class="telin">
					<label><?=lang('address_phone') ?>*</label><br>
					<input type="text" name="phonepref" class="phone" value="<?=explode("-",assign_value('phone', $phone))[0]?>"><input type="text" name="phone" value="<?=explode("-",assign_value('phone', $phone))[1]?>" style="" class="phoneaft" onchange="" required>
					<br>
					<span class="form-error" style="color:red"><?=form_error('phone') ?></span>
				</p>
			</div>

		</div>

		<div class="form-group">
			<label for="address1">Address Line One*</label>
			<?=form_input(['name'=>'address1','value'=>assign_value('address1', $address1)]) ?>
			<span class="form-error" style="color:red"><?=form_error('address1') ?></span>
		</div>
		<div class="form-group">
			<label for="address1">Address Line Two</label>
			<?=form_input(['name'=>'address2','value'=>assign_value('address2', $address2)]) ?>
			<span class="form-error" style="color:red"><?=form_error('address2') ?></span>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="country_id">Country*</label>
					<?=form_dropdown('country_id', $countries_menu, assign_value('country_id', $country_id), 'id="country_id" class="country_id"');?>	
					<span><a href='javascript:;' class="notification awtt" title="Changing your country means you're changing your phone number"> <i class="fa fa-warning"></i> NOTE: <i class='fa fa-question-circle'></i></a></span>
					<span class="form-error" style="color:red"><?=form_error('country_id') ?></span>
				</div>
			</div>
			<div class="col-md-3">
				<label for="city"><?=lang('address_city') ?></label>
				<?=form_input(['name'=>'city', 'value'=>assign_value('city',$city)]);?>
				<span class="form-error" style="color:red"><?=form_error('city') ?></span>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">State*</label>
					<?=form_dropdown('zone_id', $zones_menu, assign_value('zone_id', $zone_id), 'id="zone_id" ');?>
					<span class="form-error" style="color:red"><?=form_error('zone_id') ?></span>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="form-group">
					<label for="zip">Zip</label>
					<?=form_input(['maxlength'=>'10', 'name'=>'zip', 'value'=> assign_value('zip',$zip)]);?>
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
				if(data == 1 || data == 0){
					location.reload();
				}else{
					message('error', 'Please fill all fields before submiting.');
				}
			});
		})
	});
	$(".awtt").tooltip();
	<?php if(validation_errors()):
	$errors = \CI::form_validation()->get_error_array(); ?>

	var formErrors = <?php echo json_encode($errors);?>
	
	for (var key in formErrors) {
		console.log(formErrors);
		if (formErrors.hasOwnProperty(key)) {
			$('[name="'+key+'"]').parent().append('<span sytle="color:red">'+formErrors[key]+'</span>')
		}
	}
	<?php endif;?>
	$(function(){
		if($('.phone').length != 0){
			$('.phone').intlTelInput({
				initialCountry: "auto",
				nationalMode: true,
				geoIpLookup: function(callback){
					$.get('http://ipinfo.io', function(){}, 'jsonp')
					.always(function(resp){
						var countryCode = (resp && resp.country) ? resp.country : '';
						callback(countryCode);
					});
				},
				utilsScript: "<?=theme_file('lib/tel/js/utils.js') ?>"
			});
		}
		input = $('.phone');
		input.on("change", function(e) {
			var intlNumber = input.intlTelInput("getNumber");
			if (intlNumber) {
				input.val(intlNumber);
			}
		});
		
		$(".phone").on("countrychange",function(e, countryData){
			$(".phone").val("+"+countryData.dialCode)
			$('.country_id option').filter(function () { return $(this).html() == countryData.name;}).attr("selected","selected");
			ph = $(this).attr("placeholder");
			l = 0;
			c = "";
			if(ph != undefined)
			{		
				a = ph.toString();
				a = a.split(" ").join("");
				b = a.split(".").join("");
				c = b.split("-").join("");
				c = c.split("(").join("");
				c = c.split(")").join("");
				console.log(c);
				l = c.length
			}
			else
			{
				l = 11;
			}			
			$(".phoneaft").attr("pattern","[0-9]{"+l+"}");
			$(".phoneaft").attr("placeholder",c);

		})
	})

	$(document).on("change",".country_id",function()
	{
		$(".phoneaft").val("");
		$(".phone").val("");
	});
</script>