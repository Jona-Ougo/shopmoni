
<script>
    
    function deleteAddress(id)
    {
        if( confirm('<?php echo lang('delete_address_confirmation');?>') )
        {
            $.post('<?php echo site_url('addresses/delete');?>/'+id, function(){
                loadAddresses();
            });
        }
    }
    $('#add-address').click(function(){
        $('#modal').modal();
    })
</script>

<h3><?php echo lang('address_manager');?></h3>

<?php if(count($addresses) > 0):?>
    
    <table class="table zebra">
    <?php foreach($addresses as $a):?>
        <tr>
            <td>
                <?php echo format_address($a, true);?>
            </td>
            <td class="text-right">
                <button type="button" class="btn btn-primary btn-sm" onclick="edit_address(<?=$a['id'] ?>)">
                <?php echo lang('form_edit');?>
            </button>
                <button class="btn btn-danger btn-sm" onclick="deleteAddress(<?php echo $a['id'];?>)"><?php echo lang('form_delete');?></a>
            </td>
        </tr>
    <?php endforeach;?>
    </table>
<?php else:?>
<p>You do not have any saved address. </p>
<?php endif; ?>

<button class="btn btn-primary btn-sm blue" data-address-id="0" id="add-address"> 
    <?php echo lang('add_address');?>
</button>

<script>
    $('#edit-address').click(function(){
        $.get("<?=site_url('addresses/form/') ?>/"+$(this).attr('data-address-id'), function(data){
            $('#addresss-form').html(data);
            $('#modal').modal();
        })
    })
    function edit_address(id){
       url = "<?=site_url('addresses/address-form/') ?>/"+id;
       $.get(url, function(data){
        $('#address-form').html(data);
       })
        $('#modal').modal();
    }
</script>