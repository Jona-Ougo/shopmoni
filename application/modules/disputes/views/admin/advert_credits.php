<?php pageHeader(lang('advert_credit'));?>

<div class="text-right">
    <a class="btn btn-primary" href="<?php echo site_url('zeus/advert_credit/add'); ?>"><i class="icon-plus"></i> <?php echo lang('add_advert_credit');?></a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th><?php echo lang('id');?></th>
            <th><?php echo lang('value');?></th>
            <th><?php echo lang('amount');?></th>
            <th><?php echo lang('status');?></th>
            <th><?php echo lang('created_at');?></th>
            <th></th>
        </tr>
    </thead>
    <?php echo (count($advert_credit) < 1)?'<tr><td style="text-align:center;" colspan="5">'.lang('no_advert_credit').'</td></tr>':''?>
    <?php if ($advert_credit): ?>
    <tbody id="banners_sortable">
    <?php

    foreach ($advert_credit as $advert): ?>
        <tr>
            <td><?php echo $advert->advert_credit_id; ?></td>
            <td><?php echo $advert->value; ?></td>
            <td><?php echo $advert->amount; ?></td>
            <td><?php echo ($advert->status == "enabled") ? "Yes" : "No"; ?></td>
            <td><?php echo $advert->created_at; ?></td>
            <td class="text-right">
                <div class="btn-group">
                    <a class="btn btn-default" id="edit-advert-banner" data-advertid="<?php echo $advert->advert_credit_id; ?>" data-value="<?php echo $advert->value; ?>" data-amount="<?php echo $advert->amount; ?>"><i class="icon-pencil"></i></a>
                    <a class="btn btn-danger" href="<?php echo site_url('/zeus/advert_credit/remove/'.$advert->advert_credit_id);?>" onclick="return confirmDelete();"><i class="icon-times "></i></a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <?php endif;?>
</table>

<div id="editAdvertModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Advert Credit</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name"><?php echo lang('value');?> </label>
                    <?php echo form_input(['name'=>'value', 'id' => 'edit-value', 'class'=>'form-control']); ?>
                </div>

                <div class="form-group">
                    <label for="name"><?php echo lang('amount');?> </label>
                    <?php echo form_input(['name'=>'amount', 'id' => 'edit-amount', 'class'=>'form-control']); ?>
                </div>

                <div class="form-group">
                    <?php echo form_input(['name'=>'id', 'id' => 'edit-id', 'type' => 'hidden', 'class'=>'form-control']); ?>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" id="edit_advert_credit" value="<?php echo lang('save');?>"/>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function confirmDelete(){
        return confirm('<?php echo lang('confirm_delete_advert_credit');?>');
    }

    $(document).on('click', '#edit-advert-banner', function() {
        $("#edit-value").val($(this).data("value"));
        $("#edit-amount").val($(this).data("amount"));
        $("#edit-id").val($(this).data("advertid"));
        $("#editAdvertModal").modal("show");
    });

    $("#edit_advert_credit").click( function(e) {
        e.preventDefault();

        var advert_value = $("#edit-value").val();
        var advert_amount = $("#edit-amount").val();
        var advert_id = $("#edit-id").val();

        var currentBtnHtml = $(this).val();

        $.ajax({
            url: "/zeus/advert_credit/edit",
            type: "post",
            data: {
                "value": advert_value,
                "amount": advert_amount,
                "advert_credit_id": advert_id
            },
            dataType: 'json',
            beforeSend: function () {
                $("#edit_advert_credit").attr("disabled", true).val("loading...")
            },
            success: function (data) {

                if (data.status == "success") {
                    message('success', 'Advert credit updated successfully.', '');
                    setTimeout( function() {
                        location.reload();
                    }, 3000);
                } else {
                    message('error', data.message, '');
                    setTimeout( function() {
                        location.reload();
                    }, 3000);
                }
            },
            error: function () {
                message('error', 'The advert credit update not successful.', '');
                setTimeout( function() {
                    location.reload();
                }, 3000);
            },
            complete: function () {
                $("#editAdvertModal").modal("hide");
                $("#edit_advert_credit").attr("disabled", false).val(currentBtnHtml);
            }
        });
    })
</script>
