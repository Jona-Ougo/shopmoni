<div class="page-header">
    <h1><?php echo lang('customers');?></h1>
</div>


<table class="table table-striped">
    <thead>
        <tr>
            <?php
            foreach(['lastname', 'firstname', 'email', 'active'] as $thead)
            {
                $url = 'admin/customers/'.$thead.'/';
                $icon = '';
                if($field == $thead)
                {
                    $icon = ' <i class="icon-chevron-down"></i>';

                    if($by == 'ASC')
                    {
                        $url .= 'DESC/';
                        $icon = ' <i class="icon-chevron-up"></i>';
                    }
                    else
                    {
                        $url .= 'ASC/';
                    }
                }
                else
                {
                    $url .= 'ASC/';
                }
                $url .= $page;

                echo '<th><a href="'.site_url($url).'">'.lang($thead).$icon.'</a></th>';
            }
            ?>
        </tr>
    </thead>

    <tbody>
        <?php
        $page_links = CI::pagination()->create_links();

        if($page_links != ''):?>
        <tr><td colspan="5" style="text-align:center"><?php echo $page_links;?></td></tr>
    <?php endif;?>
    <?php echo (count($customers) < 1)?'<tr><td style="text-align:center;" colspan="5">'.lang('no_customers').'</td></tr>':''?>
    <?php foreach ($customers as $customer):?>
        <tr>
            <?php /*<td style="width:16px;"><?php echo  $customer->id; ?></td>*/?>
            <td><?php echo  $customer->lastname; ?></td>
            <td class="gc_cell_left"><?php echo  $customer->firstname; ?></td>
            <td><a href="mailto:<?php echo  $customer->email;?>"><?=sensor($customer->email); ?></a></td>
            <td>
                <?php if($customer->active == 1)
                {
                    echo 'Yes';
                }
                else
                {
                    echo 'No';
                }
                ?>
            </td>
            
        </tr>
    <?php endforeach;
    if($page_links != ''):?>
    <tr><td colspan="5" style="text-align:center"><?php echo $page_links;?></td></tr>
<?php endif;?>
</tbody>
</table>
