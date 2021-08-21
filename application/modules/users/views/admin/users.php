<?php pageHeader(lang('admins')) ?>

<script type="text/javascript">
function areyousure()
{
    return confirm('<?php echo lang('confirm_delete');?>');
}
</script>

<div class="text-right">
    <a class="btn btn-primary" href="<?php echo site_url('admin/users/form'); ?>"><i class="icon-plus"></i> <?php echo lang('add_new_admin');?></a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th><?php echo lang('firstname');?></th>
            <th><?php echo lang('lastname');?></th>
            <th><?php echo lang('email');?></th>
            <th><?php echo lang('username');?></th>
            <th>Group</th>
            <th/>
        </tr>
    </thead>
    <tbody>
<?php foreach ($admins as $admin):?>
        <tr>
            <td><?php echo $admin->firstname; ?></td>
            <td><?php echo $admin->lastname; ?></td>
            <td><a href="mailto:<?php echo $admin->email;?>"><?php echo $admin->email; ?></a></td>
            <td><?php echo $admin->username; ?></td>
            <td><?=\DB\DB::getCell('admin_groups', ['group_id'=>$admin->group_id], 'group_name') ?></td>
            <td class="text-right">
                <div class="btn-group">
                    <a class="btn btn-default" href="<?php echo site_url('admin/users/form/'.$admin->id);?>"><i class="icon-pencil"></i></a> 
                    <?php
                    $current_admin = \CI::session()->userdata('admin');
                    if ($current_admin['id'] != $admin->id): ?>
                    <a class="btn btn-danger" href="<?php echo site_url('admin/users/delete/'.$admin->id); ?>" onclick="return areyousure();"><i class="icon-times "></i></a>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>