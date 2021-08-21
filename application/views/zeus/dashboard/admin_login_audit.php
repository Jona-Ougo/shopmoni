<div class="page-header">
    <h1>Admin Login Audit</h1>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Admin</th>
            <th>IP</th>
            <th>Device</th>
            <th>Login Date</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($audit as $row): ?>
            <tr>
                <?php $admin = \DB\DB::firstOrNew('admin', ['id' => $row->admin_id]); ?>
                <td><?=$admin->firstname. ' '.$admin->lastname ?></td>
                <td><?=$row->ip ?></td>
                <td style="width:50%"><?=$row->device ?></td>
                <td><?=date('M d, Y g:i A', strtotime($row->created_at))  ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
