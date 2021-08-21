

<div id="addAdvertModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Upload advert</h4>
			</div>
			<div class="modal-body">
				<?php echo form_open_multipart('#', ['id'=>'submit_advert_form']); ?>
				<div class="form-group">
					<label for="name">Name </label>
					<?php echo form_input(['name'=>'name', 'id' => 'ads-name', 'class'=>'form-control']); ?>
				</div>

				<div class="form-group">
					<label for="name">Advert Placement </label>
					<?=form_dropdown('banner_collection_id',\CI::Banners()->banner_collection_input(),  'class="form-control"'); ?>
				</div>


				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="enable_date">Enable Date </label>
							<?php echo form_input(['name'=>'enable_date','id'=> 'ads-enable-date', 'placeholder'=>'yyyy-mm-dd', 'type'=>'date', 'class'=>' form-control']); ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="disable_date">Disable Date </label>
							<?php echo form_input(['name'=>'disable_date','id'=> 'ads-disable-date', 'placeholder'=>'yyyy-mm-dd', 'type'=>'date', 'class'=>' form-control']); ?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="name">Link </label>
					<?php echo form_input(['name'=>'link', 'id' => 'ads-link' , 'class'=>'form-control']); ?>
				</div>

				<div class="form-group">
					<label for="image">Image </label>
					<?php echo form_upload(['name'=>'image', 'id'=>'ads-image', 'class'=>'form-control']); ?>
				</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<input class="btn btn-success" type="submit" id="add_new_advert" value="Save"/>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
.ht
{
	font-size: 16px;
	font-weight: bolder;
	margin-bottom: 0px;
	text-align: center;
}

.bt
{
	text-align: center;
	line-height: 15px;
	font-size: 13px;
}

@media screen and (max-width: 780px)
{
	.footer-block-box
	{
		height: 420px;
	}
}
</style>
<!-- footer -->
<footer id="footer">
	<div class="footer-top">
		<div class="container">
			<div class="row">

				<div class="col-sm-12 col-md-7">
					<div class="block footer-block-box map-block">
						<div class="block-text">
							<div class="col-sm-2 col-xs-2" style="margin-top: 20px;">
								<img src="<?=theme_url('data/nov/enq.png')?>">
							</div>
							<div class="col-sm-10 col-xs-10" style="padding: 0px;">
								<div class="col-sm-12" style="padding: 0px;margin-bottom: 5px;">
									<h4 class="ht">Ask An Advisor</h4>
									<p class="bt">Need Answers to your ShopMoni Marketplace and Shopping Cash Club Activities?</p>
								</div>
								<div class="col-sm-12" style="padding: 0px;">
									<p class="col-sm-4" style="text-align: center;line-height: 15px;padding: 3px;">
										<a href="mailto:mail@mail.com" style="display: block;margin-bottom: 5px;"><i class='fa fa-envelope fa-2x'></i></a>
										<a href="mailto:mail@mail.com" style="display: block;font-size: 12px;">cs@shopmoni.com</a>
										<span style="font-size: 12px;">Weekdays<br /> 12pm - 8pm<br />And all day on weekend and holidays</span>
									</p>
									<p class="col-sm-4" style="text-align: center;line-height: 15px;padding: 3px;">
										<a href="#" style="display: block;margin-bottom: 5px;"><i class='fa fa-comments fa-2x'></i></a>
										<span style="font-size: 12px;">
											Weekdays:<br />10am - 5pm<br />
											<b>Ask us your questions</b>
										</span>
									</p>
									<p class="col-sm-4" style="text-align: center;line-height: 15px;padding: 0px;">
										<a href="#" style="display: block;margin-bottom: 5px;"><i class='fa fa-phone-square fa-2x'></i></a>
										<span style="font-size: 12px;">
											Weekdays: 8:30 - 10pm<br />
											+23480<br />
											+23480<br />
											+23480<br />
											International Callers<br />
											+18979870789
										</span>
									</p>
								</div>
							</div>
							<div class="col-sm-12">
								<form>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
										<input class="form-control" placeholder="E-commerce Digest, Stay Informed for success" required>
										<div class="input-group-btn">
											<button type="submit" class="btn" style="background: #fd7400;color: #fff;">Sign Up</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12 col-md-5">
					<div class="block footer-block-box map-block">
						<div class="block-text">
							<img src="<?=theme_url('data/nov/anywhere.gif') ?>" class="img img-responsive">
						</div>
					</div>
				</div>
				<!-- <div class="col-sm-12 col-md-4">
					<div class="block footer-block-box map-block">
						<div class="block-head">
							<div class="block-title">
								<div class="block-icon">
									<img alt="store icon" src="<?=theme_url('data/location-icon.png') ?>">
								</div>
								<div class="block-text">
									<div class="block-title-text text-sm">FIND A</div>
									<div class="block-title-text text-lg">shopMoni store</div>
								</div>
							</div>
						</div>
						<div class="block-inner">
							<div class="block-info clearfix">
								Find shopMoni Store near you!
							</div>
							<a href="#" class="sv-btn-default">Find Store</a>
						</div>
					</div>
				</div> -->
				<!-- <div class="col-sm-12 col-md-4">
					<div class="block footer-block-box">
						<div class="block-head">
							<div class="block-title">
								<div class="block-icon">
									<img alt="store icon" src="<?=theme_url('data/email-icon.png') ?>">
								</div>
								<div class="block-text">
									<div class="block-title-text text-sm">SUBSCRIBE TO</div>
									<div class="block-title-text text-lg">shopMoni shop EMAILS</div>
								</div>
							</div>
						</div>
						<div class="block-inner">
							<div class="block-info clearfix">
								Lorem Ipsum is simply dummy text of the printing
							</div>
							<div class="block-input-box box-radius clearfix">
								<form class="mc4wp-form">
									<input type="email" placeholder="Email address">
									<input type="submit" value="Go">
									<i aria-hidden="true" class="fa fa-angle-right"></i>
								</form>
							</div>
						</div>
					</div>
				</div> -->
				<!-- <div class="col-sm-12 col-md-4">
					<div class="block footer-block-box">
						<div class="block-head">
							<div class="block-title">
								<div class="block-icon">
									<img src="<?=theme_url('data/partners-icon.png') ?>" alt="store icon">
								</div>
								<div class="block-text">
									<div class="block-title-text text-sm">our</div>
									<div class="block-title-text text-lg">partners</div>
								</div>
							</div>
						</div>
						<div class="block-inner">
							<div class="block-owl">
								<ul class="kt-owl-carousel list-partners" data-nav="true" data-autoplay="true" data-loop="true" data-items="1">
									<li class="partner"><a href="#"><img src="<?=theme_url('data/partner1.jpg') ?>" alt="partner"></a></li>
									<li class="partner"><a href="#"><img src="<?=theme_url('data/partner2.jpg') ?>" alt="partner"></a></li>
									<li class="partner"><a href="#"><img src="<?=theme_url('data/partner3.jpg') ?>" alt="partner"></a></li>

								</ul>
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	<div class="footer-middle">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3 block-link-wapper">
					<div class="block-link">
						<ul class="list-link">
							<li class="head"><a href="<?=site_url('/login') ?>">Quick Links</a></li>
							<li><a href="<?=site_url('login') ?>">Login</a></li>
							<li><a href="#">Shopping Cash Club</a></li>
							<li><a href="<?=site_url('page/buyers-protection') ?>">Buyer Protection</a></li>
							<li><a href="<?=site_url('page/return-policy') ?>">Return Policy</a></li>
							<li><a href="<?=site_url('page/terms-of-purchase') ?>">Terms of Purchase</a></li>
							<li><a href="#">Shipping Policy</a></li>
							<li><a href="<?=site_url('page/return-policy') ?>">Return Policy</a></li>
						</ul>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-3 block-link-wapper">
					<div class="block-link">
						<ul class="list-link">
							<li class="head"><a href="#">Information</a></li>
							<li><a href="<?=site_url('page/about-us') ?>">About Us</a></li>
							<li><a href="#">Band of Trust</a></li>
							<li><a href="#">ShopClues History</a></li>
							<li><a href="#">News</a></li>
							<li><a href="#">In the Press</a></li>
							<li><a href="#">Awards New</a></li>
							<li><a href="<?=site_url('page/careers') ?>">Careers</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 block-link-wapper">
					<div class="block-link">
						<ul>
							<li class="head"><a href="#">Contact Us</a></li>
							<li><a href="#">Customer Support</a></li>
							<li><a href="#">Merchant Support</a></li>
							<li><a href="#">Merchant Inquiries</a></li>
							<li><a href="#">Product Reviews</a></li>
							<li><a href="#">Brand Inquiries</a></li>
							<li><a href="#">Bulk Orders</a></li>
							<li><a href="#">Contact Us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 block-link-wapper">
					<div class="block-link">
						<ul class="list-link">
							<li class="head"><a href="#">help</a></li>
							<li><a href="#">See all Help</a></li>
							<li><a href="#">My Account</a></li>
							<li><a href="#">FAQs</a></li>
						</ul>
						<ul>
							<li class="head"><a href="#">OTHER SERVICES</a></li>
							<li><a href="#">Market America Gear</a></li>
							<li><a href="#">Apply for Market</a></li>
							<li><a href="#">America Credit Card</a></li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="footer-social">
		<div class="container">
			<div class="clearfix">
				<div class="block-social">
					<ul class="list-social">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
						<li><a href="#"><i class="fa fa-pied-piper"></i></a></li>
						<li><a href="#"><i class="fa fa-skype"></i></a></li>
					</ul>
				</div>
				<div class="block-payment">
					<ul class="list-logo">
						<li><a href="#"><img src="<?=theme_url('data/payment1.png') ?>" alt="Payment Logo"></a></li>
						<li><a href="#"><img src="<?=theme_url('data/payment2.png') ?>" alt="Payment Logo"></a></li>
						<li><a href="#"><img src="<?=theme_url('data/payment3.png') ?>" alt="Payment Logo"></a></li>
						<li><a href="#"><img src="<?=theme_url('data/payment4.png') ?>" alt="Payment Logo"></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="clearfix">
				<div class="block-coppyright">
					© <?=date('Y') ?> shopMoni Store. All Rights Reserved.
				</div>
				<div class="block-shop-phone">
					Shop by phone <strong>1-899-353-2268</strong>
				</div>
			</div>
		</div>
	</div>
	
</footer>
<!-- ./footer -->
<a href="#" class="scroll_top" title="Scroll to Top">Scroll</a>
<?=theme_file('lib/bootstrap/js/bootstrap.min.js', 'js') ?>
<?=theme_file('lib/jquery.bxslider/jquery.bxslider.min.js', 'js') ?>
<?=theme_file('lib/owl.carousel/owl.carousel.min.js', 'js') ?>
<?=theme_file('lib/jquery-ui/jquery-ui.min.js', 'js') ?>
<?=theme_file('lib/fancyBox/jquery.fancybox.js', 'js') ?>
<?=theme_file('lib/easyzoom/easyzoom.js', 'js') ?>
<?=theme_file('lib/countdown/jquery.plugin.js', 'js') ?>
<?=theme_file('lib/toastr/toastr.min.js', 'js') ?>
<?=theme_file('js/jquery.spin.js', 'js') ?>
<?=theme_file('lib/countdown/jquery.countdown.js', 'js') ?>
<?=theme_file('lib/tel/js/intlTelInput.min.js', 'js') ?>
<?=theme_file('js/script.js', 'js') ?>
<?=theme_file('lib/jquerymSimpleSlider/jquery.mSimpleSlidebox.js', 'js') ?>
<script type="text/javascript" src="<?=base_url('assets/js/pickadate/picker.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/pickadate/picker.date.js');?>"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.js">
</script>

<style type="text/css">
.error
{
	color: red;
}
</style>
<script>
	$("#registration_form").validate({
		rules: {
			password: {
				required : true,
				minlength: 6
			},
			confirm: {
				required : true,
				minlength: 6,
				equalTo: '#rpassword'
			}
		},
		messages: {
			confirm: {
				equalTo: "Please enter a password that's same as the one above"
			}
		}
	});
	$("#loginForm").validate();
	$(function () {
		$(".slidebox").mSlidebox();
	});

	$(function(){
		$("#add-adverts").click( function (e) {
			$('.datepicker').pickadate({formatSubmit:'yyyy-mm-dd', hiddenName:true, format:'mm/dd/yyyy'});
			$("#addAdvertModal").modal('show');
		});
	});

	$(function () {

		$("#add_new_advert").click( function(e) {
			e.preventDefault();

			var form = $('#submit_advert_form')[0];

            // Create an FormData object
            var data = new FormData(form);
            $.ajax({
            	url: "/banners/add",
            	type: "post",
            	data: data,
            	contentType: false,
            	processData: false,
            	beforeSend: function () {
            		$("#add_new_advert").attr("disabled", true).val("loading...")
            	},
            	success: function (data) {
            		var newdata = JSON.parse(data);
            		if (newdata.status == "success") {
            			message('success', 'Advert Uploaded successfully. To be reviewed shortly by the admin', '');
            			$('#submit_advert_form')[0].reset();
            			$("#addAdvertModal").modal("hide");

            		} else {
            			message('error', newdata.message, '');

            		}
            	},
            	error: function () {
            		message('error', 'Advert creation failed. Please try again later', '');

            	},
            	complete: function () {
            		$("#add_new_advert").attr("disabled", false).val('Save');
            	}
            });
        });
	});

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
			//This selects the Visitor's country 
			//$('#country_id option').filter(function () { return $(this).html() == countryData.name;}).attr("selected","selected");
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

	$(".phone2").on("countrychange",function(e, countryData){
		$(".phone2").val("+"+countryData.dialCode)
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
		$(".phoneaft2").attr("pattern","[0-9]{"+l+"}");
		$(".phoneaft2").attr("placeholder",c);

	})

	$(function(){
		if($('.phone2').length != 0){
			$('.phone2').intlTelInput({
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
		input = $('.phone2');
		input.on("change", function(e) {
			var intlNumber = input.intlTelInput("getNumber");
			if (intlNumber) {
				input.val(intlNumber);
			}
		});
	})

	function updateItemCount(items, subtotal = '')
	{
		var _items = parseInt(items);
		if(_items <= 1)
			s = 'Item';
		else
			s = 'Items';
		$('#itemCount').text('('+items+' '+s+')');
		$('#cartTotal').text(subtotal);
	}

	function message(type = 'success', message='', title = ''){
		toastr.options = {'progressBar': true, 'timeOut': 5000};
		switch(type){
			case 'success':
			toastr.success(title, message);
			break

			case 'warning':
			toastr.warning(title, message);
			break

			case 'error':
			toastr.error(title, message);
			break;

			default:
			toastr.info(title, message);
			break;
		}
	}

	function addToWishList(product_id = 0){
		url = "<?=site_url('/cart/add-to-wish-list') ?>/"+product_id

		$.get(url, function(response){
			if(response == 1){
				var link = "<a href='<?=site_url('/cart/wish-list') ?>' style='color:#fff !important; text-decoration:underline'>View Wish List</a>";
				message('success', 'Product has been added to your wishlist. '+link);
			}else if(response == 2){
				message('info', 'Product is already in your wishlist');
			}else{
				message('error', 'Product could not be added to your wishlist');
			}

			console.log(response);
		})
	}
	$(".owl").owlCarousel({
		loop:true,
		margin:10,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	})
	$(".awtt").tooltip();
	$(document).on("keyup, keydown","input.phone",function(){
		return false;
	})

	setInterval(function(){
		$(".owl .owl-next").trigger("click")
	},4000)
</script>
</body>
</html>