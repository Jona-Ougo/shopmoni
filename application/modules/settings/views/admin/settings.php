<?php pageHeader(lang('settings'));?>

<?php echo form_open_multipart('admin/settings');?>
    <fieldset>
        <legend><?php echo lang('shop_details');?></legend>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label><?php echo lang('company_name');?></label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'company_name', 'value'=>assign_value('company_name', @$company_name)));?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>First Name</label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'firstname', 'value'=>assign_value('firstname', @$firstname)));?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Last Name</label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'lastname', 'value'=>assign_value('lastname', @$lastname)));?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Email</label>
                    <?php echo form_input(array('class'=>'form-control', 'name'=>'email', 'value'=>assign_value('email', @$email)));?>
                </div>
            </div>

        </div>
    </fieldset>

    <fieldset>
        <legend><?php echo lang('ship_from_address');?></legend>
        
        <div class="form-group">
            <label><?php echo lang('country');?></label>
            <?php echo form_dropdown('country_id', $countries_menu, assign_value('country_id', $country_id), 'id="country_id" class="form-control"');?>
        </div>

        <div class="form-group">
            <label><?php echo lang('address1');?></label>
            <?php echo form_input(array('name'=>'address1', 'class'=>'form-control','value'=>assign_value('address1',$address1)));?>
        </div>

        <div class="form-group">
            <?php echo form_input(array('name'=>'address2', 'class'=>'form-control','value'=> assign_value('address2',$address2)));?>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label><?php echo lang('city');?></label>
                    <?php echo form_input(array('name'=>'city','class'=>'form-control', 'value'=>assign_value('city',$city)));?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?php echo lang('state');?></label>
                    <?php echo form_dropdown('zone_id', $zones_menu, assign_value('zone_id', $zone_id), 'id="zone_id" class="form-control"');?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label><?php echo lang('zip');?></label>
                    <?php echo form_input(array('maxlength'=>'10', 'class'=>'form-control', 'name'=>'zip', 'value'=> assign_value('zip',$zip)));?>
                </div>
            </div>
        </div>
    </fieldset>


    <fieldset>
        <legend><?php echo lang('order_inventory');?></legend>

        <?php echo form_textarea(array('name'=>'order_statuses', 'value'=>assign_value('order_statuses',$order_statuses), 'id'=>'order_statuses_json'));?>

        <div class="">
            <label>
                <?php echo form_checkbox('inventory_enabled', '1', assign_value('inventory_enabled',$inventory_enabled));?> <?php echo lang('inventory_enabled');?>
            </label>
        </div>

        <div class="">
            <label>
                <?php echo form_checkbox('allow_os_purchase', '1', assign_value('allow_os_purchase',$allow_os_purchase));?> <?php echo lang('allow_os_purchase');?>
            </label>
        </div>

    </fieldset>

    <fieldset>
        <legend><?php echo lang('tax_settings');?></legend>

        <div class="form-group">
            <label><?php echo lang('tax_address');?></label>
            <?php echo form_dropdown('tax_address', ['ship'=>lang('shipping_address'), 'bill'=>lang('billing_address')], assign_value('tax_address',$tax_address), 'class="form-control"');?>
        </div>

        <div class="">
            <label>
                <?php echo form_checkbox('tax_shipping', '1', assign_value('tax_shipping',$tax_shipping));?> <?php echo lang('tax_shipping');?>
            </label>
        </div>
    </fieldset>


    <input type="submit" class="btn btn-primary" value="<?php echo lang('save');?>" />

</form>

<script type="text/template" id="orderStatusTemplate">
    <tr>
        <td>
            <input type="radio" value="{{status}}" name="order_status">
        </td>
        <td>
            {{status}}
        </td>
        <td style="text-align:right;">
            <button type="button" class="removeOrderStatus btn btn-danger" value="{{status}}"><i class="icon-close"></i></button>
        </td>
    </tr>
</script>


<script>

    var orderStatus = <?php echo json_encode($order_status);?>;
    var orderStatuses = <?php echo $order_statuses;?>;
    var orderStatusTemplate = $('#orderStatusTemplate').html();

    function renderOrderStatus()
    {
        $('#orderStatuses').html('');
        $.each(orderStatuses, function(id, val){
            var data = {status:val}
            var output = Mustache.render(orderStatusTemplate, data);
            $('#orderStatuses').append(output);
            $('input[value="'+orderStatus+'"]').prop('checked', true);
        });
        //update the order_statuses_json field
        $('#order_statuses_json').val( JSON.stringify(orderStatuses) );
    }

    function add_status()
    {
        var status = $('#new_order_status_field').val();
        orderStatuses[status] = status;
        renderOrderStatus();

        $('#new_order_status_field').val('');
    }

    function deleteStatus(status)
    {
        delete orderStatuses[status];
        renderOrderStatus();
    }

    $(document).ready(function(){
        $('#country_id').change(function(){
            $.post('<?php echo site_url('admin/locations/get_zone_menu');?>',{id:$('#country_id').val()}, function(data) {
              $('#zone_id').html(data);
            });
        });

        renderOrderStatus();

        $('#emailMethod').bind('click change keyup keypress', function(){
            $('.emailMethods').hide();
            $('#email_'+$(this).val()).show();
        });


        $('#new_order_status_field').on('keyup', function(event){
            if (event.which == 13) {
                add_status();
            }
        }).keypress(function(event){
            if (event.which  == 13) {
                event.preventDefault();
                return false;
            }
        });

        $('#orderStatuses').on('click', '.removeOrderStatus', function(){
            if(confirm('<?php echo lang('confirm_delete_order_status');?>'))
            {
                deleteStatus($(this).val());
            }
        });

        $('#orderStatuses').on('change', 'input[name="order_status"]', function(){
            orderStatus = $(this).val();
        });
    });

</script>

<style type="text/css">
#order_statuses_json, .emailMethods {
   display:none;
}
#email_<?php echo $email_method;?> {
    display:block;
}
</style>
