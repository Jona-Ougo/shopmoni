<?php pageHeader(lang('banner_orders')) ?>
<?php if(DEV == 1 ): ?>
<?php endif; ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Advert <?php echo lang('name');?></th>
            <th>Customer Name</th>
            <th>Advert Credit</th>
            <th>Customer type</th>
        </tr>
    </thead>
    <?php echo (count($banner_orders) < 1)?'<tr><td style="text-align:center;" colspan="5">'.lang('no_banner_orders').'</td></tr>':''?>
    <?php if ($banner_orders): ?>
    <tbody>
    <?php

    foreach ($banner_orders['adverts'] as $banner_order):?>
        <tr>
            <td><?php echo $banner_order->name;?></td>
            <td><?php echo $banner_order->firstname. " ". $banner_order->lastname; ?></td>
            <td><?php echo $banner_order->advert_credit;?></td>
            <td><?php echo $banner_order->access;?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <?php endif;?>
</table>
