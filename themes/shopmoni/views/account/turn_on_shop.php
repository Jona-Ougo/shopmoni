<div class="container product-page">
  <div class="st-default main-wrapper clearfix">
   <div class="block block-breadcrumbs clearfix">
    <ul>
      <li class="home">
        <a href="<?=site_url() ?>"><i class="fa fa-home"></i></a>
        <span></span>
      </li>
      <li><a href="<?=site_url('account') ?>">Account</a><span></span></li>
      <li>Turn on Shop</li>
    </ul>
  </div>
  <br/>

  <div class="row">
   <div class="col-md-8">
    <?=form_open('turn-on-shop') ?>
    <div class="form-group">
      <label for="company">Shop Name*</label>
      <?=form_input(['name'=>'shop_name', 'value'=>assign_value('shop_name', $shop_name), 'id'=>'shopname', 'onchange'=>'checkshopname()'],'required') ?>
      <span class="form-error" style="color:red" id="shopname_error"><?=form_error('shop_name') ?></span>
    </div>

    <div class="form-group">
      <label for="company">Company Name</label>
      <?=form_input(['name'=>'company', 'value'=>assign_value('company', $company)]) ?>
      <span class="form-error" style="color:red"><?=form_error('company') ?></span>
    </div>

    <div class="form-group">
      <input type="radio" name="operation_location" value="home" checked> I'm operating from home
      <br>
      <input type="radio" name="operation_location" value="company"> I'm operating as a Company
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <p class="telin" style="width: 400px;">
            <label>Phone 1*</label><br>
            <input type="text" class="phone" name="phonepref" value="<?=explode("-",assign_value('phonepref', $phone_1))[0]?>" style="width: 100px;display: inline-block;border-right: none;"><input type="text" name="phone_1" value="<?=explode("-",assign_value('phone_1', $phone_1))[1]?>" style="width: 200px;display: inline-block;" class="phoneaft" required>
            <br>
            <span class="form-error" style="color:red"><?=form_error('phone_1') ?></span>
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <p class="telin" style="width: 400px;">
            <label for="phone">Phone Two</label><br>
            <input type="text" name="phonepref2" class="phone2" value="<?=$phone_2 == ""? "" : explode("-",assign_value('phonepref', $phone_2))[0]?>" style="width: 100px;display: inline-block;border-right: none;"><input type="text" name="phone_2" value="<?=$phone_2 == "" ? "":explode("-",assign_value('phonepref', $phone_2))[1]?>" style="width: 200px;display: inline-block;" class="phoneaft2" required>
            <br>
            <span class="form-error" style="color:red"><?=form_error('phone_2') ?></span>
          </p>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="phone">Full Shop Address*</label>
      <?=form_input(['name'=>'address', 'value'=>assign_value('address', $address), 'id'=>'address']) ?>
      <span class="form-error" style="color:red"><?=form_error('address') ?></span>
    </div>

    <div class="row">
     <div class="col-md-3">
      <div class="form-group">
        <label for="country_id">Country*</label>
        <?=form_dropdown('country_id', $countries_menu, assign_value('country_id', $country_id), 'id="country_id" class="country_id"');?> 
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">State*</label>
        <?=form_dropdown('zone_id', $zones_menu, assign_value('zone_id', $zone_id), 'id="zone_id" required');?>
        <span class="form-error" style="color:red"><?=form_error('zone_id') ?></span>
      </div>
    </div>
    <div class="col-md-3">
      <label for="city"><?=lang('address_city') ?>*</label>
      <?=form_input(['name'=>'city', 'value'=>assign_value('city',$city)]);?>
      <span class="form-error" style="color:red"><?=form_error('city') ?></span>
    </div>
    <div class="col-md-3">
      <label for="zip">Zip Code</label>
      <?php $required = $country_id == 156 ? '' : "required='required' " ?>
      <?=form_input(['maxlength'=>'10','name'=>'zip', 'value'=> assign_value('zip',$zip), $required]);?>
      <span class="form-error" style="color:red"><?=form_error('zip') ?></span>
    </div>
  </div>

  <input type="submit" class="button" value="Submit and activate">
  <?=form_close() ?> 
</div>

<div class="col-md-4">
 <div class="well">
   <strong>Some advantages of using shop on shopmoni</strong>
   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat architecto reprehenderit provident, deserunt cum neque excepturi quibusdam at qui adipisci aut, quae voluptate impedit nobis earum laboriosam, iusto vel! Eligendi!<br>
   Lorem ipsum dolor

 </div>
</div>
</div>
</div>
</div>


<script>
  $(function(){
    $('#country_id').change(function(){
      $('#zone_id').load('<?php echo site_url('addresses/get-zone-options');?>/'+$('#country_id').val());
    });

    var address = '<?=$address ?>';

    $('input[name=operation_location]').change(function(){
     checked = $('input[name=operation_location]:checked').val();

     if(checked == 'home'){
      $('#address').val(address);
    }else{
      $('#address').val('');
    }
  })
    
  });


  function checkshopname()
  {
    shopname = $('#shopname').val();
    url = "<?=site_url('check-shop-name') ?>"
    data = {'shopname':shopname};
    $.post(url, data, function(response){
      if(response == 1){
        $('#shopname_error').html(shopname+ ' is not avaliable, please choose a diffrent name.');
      }else{
        $('#shopname_error').html('');
      }
    })
  }
</script>

