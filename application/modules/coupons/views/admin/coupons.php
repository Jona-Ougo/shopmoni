<script type="text/javascript">
function areyousure()
{
    return confirm('<?=lang('confirm_deleteCoupon');?>');
}
</script>

<?php pageHeader(lang('coupons'));?>

<a class="btn btn-primary" style="float:right;" href="<?=site_url('admin/coupons/form'); ?>"><i class="icon-plus"></i> <?=lang('add_new_coupon');?></a>

<table class="table">
    <thead>
        <tr>
          <th><?=lang('code');?></th>
          <th>Coupon Name</th>
          <th><?=lang('usage');?></th>
          <th></th>
        </tr>
    </thead>
    <tbody>
    <?=(count($coupons) < 1)?'<tr><td style="text-align:center;" colspan="3">'.lang('no_coupons').'</td></tr>':''?>
    
    <?php foreach ($coupons as $coupon):?>
        <tr>
            <td><?= $coupon->code; ?></td>
            <td><?= $coupon->name; ?></td>
            <td>
              <?= $coupon->num_uses ." / ". $coupon->max_uses; ?>
            </td>
            <td class="text-right">
                <div class="btn-group">
                    <a class="btn btn-default" href="<?=site_url('admin/coupons/form/'.$coupon->id); ?>"><i class="icon-pencil"></i></a>
                    <a class="btn btn-danger" href="<?=site_url('admin/coupons/delete/'.$coupon->id); ?>" onclick="return areyousure();"><i class="icon-times "></i></a>
                </div>
            </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>